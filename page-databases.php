<?php
  

  require 'header.php';
?>
  <div id="wrapper2">
    <div id="featured" class="container">
      <div class="row">
        <div class="box1">
          <h2><span class="icon icon-pencil"></span>Таблички</h2>
          
          <?php 
            try {
              $pdo = new PDO('mysql:host=127.0.0.1;dbname=poloklinnik;charset=utf8', 'root', 'root');
              $pdo->setAttribute(
                PDO::ATTR_ERRMODE, 
                PDO::ERRMODE_EXCEPTION
              );
              
            } catch(PDOException $e) {
              echo 'ERROR: ' . $e->getMessage(); 
            }

            //сначала заносим новые данные в таблицу
            if (!empty($_POST)) {
              $p_name = isset($_POST['name']) ? $_POST['name'] : '';
              $p_insurance_num = isset($_POST['insurance_num']) ? $_POST['insurance_num'] : '';
              $p_email = isset($_POST['email']) ? $_POST['email'] : '';
              $p_sex = isset($_POST['sex']) ? $_POST['sex'] : '';
              $p_history = isset($_POST['history']) ? $_POST['history'] : '';

              // проверим нет ли такого пациента
              $stmt = $pdo->prepare('
              SELECT id FROM patients WHERE name = :name AND email = :email;
              ');

              $stmt->bindParam(':name', $p_name);
              $stmt->bindParam(':email', $p_email);
              $stmt->execute();

              // результат
              $result = $stmt->fetch(PDO::FETCH_ASSOC);

              //запишем новые значения
              if (empty($result)) {
                $stmt = $pdo->prepare('
                INSERT INTO patients (name, insurance_num, email, sex, history)
                VALUES (:name, :insurance_num, :email, :sex, :history);               
                ');
                $stmt->bindParam(':name', $p_name);
                $stmt->bindParam(':email', $p_email);
                $stmt->bindParam(':sex', $p_sex);
                $stmt->bindParam(':history', $p_history);
                $stmt->bindParam(':insurance_num', $p_insurance_num);
                $stmt->execute();
              } 
              // или обновим старые
              else {
                $stmt = $pdo->prepare('
                UPDATE patients 
                SET name=:name, insurance_num=:insurance_num, email=:email, sex=:sex, history=:history
                WHERE id=:id
                ');
                $stmt->bindParam(':id', $result['id']);
                $stmt->bindParam(':name', $p_name);
                $stmt->bindParam(':email', $p_email);
                $stmt->bindParam(':sex', $p_sex);
                $stmt->bindParam(':history', $p_history);
                $stmt->bindParam(':insurance_num', $p_insurance_num);
                $stmt->execute();
              }

              //а теперь зададим номер карточки пациента
              $stmt = $pdo->prepare('
              SELECT id FROM patients WHERE name = :name AND email = :email
              ');
              $stmt->bindParam(':name', $p_name);
              $stmt->bindParam(':email', $p_email);
              $stmt->execute();
              $result = $stmt->fetch(PDO::FETCH_ASSOC);

              $stmt = $pdo->prepare('
              UPDATE patients 
              SET card_num=:id
              WHERE id=:id
              ');
              $stmt->bindParam(':id', $result['id']);
              $stmt->execute();
            }
            
           


            //выбор нужной страницы
            $curPage = isset($_GET['action']) ? $_GET['action'] : 'default';

            switch ($curPage) {
             
              case 'profile':
                
                if (isset($_GET['id'])) {
                  $stmt = $pdo->prepare('
                    SELECT * FROM patients WHERE id = :id
                    ');
                  $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                  $stmt->execute();
                  $patient = $stmt->fetch(PDO::FETCH_ASSOC);

                  if (!empty($patient)) {
                    echo '<table>';
                    foreach ($patient as $key => $value) {
                      if ($key!=='id') {
                        echo '<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
                      }
                    }
                    echo '</table>';
                    echo '<p>Не понравился пациент? Не беда, <a class="link--databases" href="'.$cur_page_name.'">выберем другого</a></p>';
                  } 
                  else {
                    echo '<p>Этот пациент на учете в психдиспансере не состоит.<br>Но всегда можно <a class="link--databases" href="'.$cur_page_name.'">выбрать другого!</a></p>';
                  }
                } else {
                  echo '<p>Пациент не выбран. Вернитесь к <a class="link--databases" href="'.$cur_page_name.'">списку пациентов</a></p>';
                }

                break;

              case 'add':
              ?>
                <h3>Нужно больше больных!</h3>

                <form action="<?php echo $cur_page_name; ?>" method="post">
                <p class="form-group">
                  <label for="name">ФИО:</label>
                  <input type="text" class="form-control"  name="name" id="name" value="test">
                </p>
                <p class="form-group">
                  <label for="insurance_num">Номер полиса:</label>
                  <input type="text" class="form-control"  name="insurance_num" id="insurance_num" value="12345">
                </p>
                <p class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control"  name="email" id="email" value="test@djchsbch.com">
                </p>
                <p class="form-group">
                  <label>Пол:</label>
                  <label for="male"><input type="radio" name="sex" id="male" value="male">М</label>
                  <label for="female"><input type="radio" name="sex" id="female" value="female">Ж</label>
                </p>
                <p class="form-group">
                  <label for="history">История болезни:</label>
                  <textarea class="form-control"  name="history" id="history">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos, blanditiis.</textarea>
                </p>
                <p class="form-group">
                  <button type="submit" class="btn submit">Отправить</button>
                </p>
              </form>
              <?php 
                echo '<p>Назад, список пациентов <a class="link--databases" href="'.$cur_page_name.'">ждет нас!</a></p>';
                break;
              
              default:

                //выводим список пациентов
                $stmt = $pdo->prepare('
                SELECT id, name, insurance_num FROM patients ORDER BY insurance_num
                ');
                $stmt->execute();

                $result = $stmt->fetchAll();

                if(count($result)>0) {
                  echo '<table><tr><td>№ полиса</td><td>ФИО</td></tr>';
                  foreach ($result as $row) {
                    echo '<tr><td>'.$row['insurance_num'].'</td><td><a class="link--databases" href="'.$cur_page_name.'?action=profile&id='.$row['id'].'">'.$row['name'].'</a></td></tr>';
                  }
                  echo ('</table>');
                } else {
                  echo 'Список пациентов пуст';
                }
                echo 'Не нашли желаемого? <a class="link--databases" href="'.$cur_page_name.'?action=add">Добавьте</a> еще одного пациента!';
                break;
            }
           ?>
        </div>
        <div class="box2">
          
        </div>
      </div>
    </div>
  </div>
<?php 
  require 'footer.php' 
?>
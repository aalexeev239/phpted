<?php
  // $_SESSION['']
  session_start();
  // обнулить массив
  // $_SESSION['goods']=[];

  require 'header.php';
?>
  <div id="wrapper2">
    <div id="featured" class="container">
      <div class="row">
        <div class="box1">
          <h2><span class="icon icon-pencil"></span>Тайтл и картинко</h2>
          <?php 
            if (!empty($cookie_message)) {
              echo $cookie_message;
              echo '<br/><a href="'.$_SERVER['REQUEST_URI'].'" class="button">Ну и ок</a>';
            } else {              
          ?>
          <form action="page-sessions.php" method="post">
            <p class="form-group">
              <img src="https://api.fnkr.net/testimg/400x100/ff6816/FFF/?text=hellish samokat">
              <label for="good">Самокат:</label>
              <input type="text" class="form-control"  name="good" id="good" value="test">
            </p>
            <p class="form-group">
              <button type="submit" class="btn submit">Купить</button>
            </p>
          </form> 
          <?php 
            }
           ?>    
          </p>
        </div>
        <div class="box2">
          <h4><span class="icon icon-pencil"></span>Самокаты:</h4>
          <p>
            <?php 
            if (isset($_POST['good'])) {
              $_SESSION['goods'][] = $_POST['good'];
            }

            //если пришел запрос на удаление
            if (isset($_POST['delete'])) {
              unset ($_SESSION['goods'][$_POST['delete']]);
            }
            //!isset($_SESSION['goods']) && 
            if (empty($_SESSION['goods'])) {
              echo "товаров нет";
            } else {
              foreach ($_SESSION['goods'] as $key => $value) {
                echo ' <form action="page-sessions.php" method="post">';
                echo '<input type="hidden" name="delete" value="'.$key.'">';
                echo $value.'<button type="submit" class="btn-icon-delete"><span class="icon icon-minus"></span></button><br>';
                echo '</form>';
              }
            }
            ?>
          </p>
        </div>
      </div>
    </div>
  </div>
<?php 
  require 'footer.php' 
?>
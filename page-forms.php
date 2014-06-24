<?php 
  require 'header.php'
?>

<section id="wrapper2">
  <div id="featured" class="container">
    <div class="box1">
      <h2><span class="icon icon-table"></span>Простая Post-форма</h2>
      <form enctype="multipart/form-data" action="page-forms.php" method="post">
        <p class="form-group">
          <label for="field1">Введите что-нибудь:</label>
          <input type="text" class="form-control"  name="field1" id="field1" value="test">
        </p>
        <p class="form-group">
          <label for="email">Введите email:</label>
          <input type="email" class="form-control"  name="email" id="email" value="test@djchsbch.com">
        </p>
        <p class="form-group">
          <label for="text-message">И еще какую-нить фигню:</label>
          <textarea class="form-control"  name="text-message" id="text-message">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos, blanditiis.</textarea>
        </p>
        <p class="form-group">
          <label for="text-message">Загрузка файла:</label>
          <!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла -->
          <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
          <!-- Название элемента input определяет имя в массиве $_FILES -->
          <input name="userfile" type="file" />
        </p>
        <p class="form-group">
          <button type="submit" class="btn submit">Отправить</button>
        </p>
      </form>
    </div>
    <div class="box2">
      <h2><span class="icon icon-print"></span>Вывод:</h2>
      <?php 

        //выводим данные
        foreach ($_POST as $key => $value) {

          if (!($key=='MAX_FILE_SIZE' || $key=='userfile')) {
            echo '<p class="form-group"><label>'.$key.':</label><strong>'.$value.'</strong></p>';
          }          
        }   

        //file upload
        $uploaddir = __DIR__.DIRECTORY_SEPARATOR.'uploads';
        $uploadfile = $uploaddir.DIRECTORY_SEPARATOR.basename($_FILES['userfile']['name']);

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            echo "Файл корректен и был успешно загружен.\n";
        } else {
            echo "Возможная атака с помощью файловой загрузки!\n";
        }      
      ?>
    </div>
  </div>
</section>

<?php 
  require 'footer.php' 
?>
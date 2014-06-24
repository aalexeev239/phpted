<?php 
  require 'header.php'
?>

<section id="wrapper2">
  <div id="featured" class="container">
    <div class="box1">
      <h2><span class="icon icon-table"></span>Простая форма</h2>
      <form action="page-forms.php">
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
          <button type="submit" class="btn submit">Отправить</button>
        </p>
      </form>
    </div>
    <div class="box2">
      <h2><span class="icon icon-print"></span>Вывод:</h2>
      <?php 
       foreach ($_GET as $key => $value) {
          $message[$key] = $value;
          echo '<p class="form-group"><label>'.$key.':</label>
          <strong>'.$value.'</strong>
          </p>';
        } 
      ?>
    </div>
  </div>
</section>

<?php 
  require 'footer.php' 
?>
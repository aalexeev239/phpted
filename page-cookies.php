<?php
  $cookie_message = '';
  if (isset($_COOKIE['login'])) {
    $cookie_message = 'Ты зашел, чувак!';
    // снять куки
    setcookie('login', $_POST['username'], time()-3600);
  } else {
    if (isset($_POST['username'])) {
      setcookie('login', $_POST['username'], time()+3600);
      //моментально перейти на другую страницу
      header('Location: '.$_SERVER['REQUEST_URI']);
    }
  }
  require 'header.php';
?>
  <div id="wrapper2">
    <div id="featured" class="container">
      <div class="row">
        <div class="box1">
          <h2><span class="icon icon-pencil"></span>Логин-пароль</h2>
          <?php 
            if (!empty($cookie_message)) {
              echo $cookie_message;
              echo '<br/><a href="'.$_SERVER['REQUEST_URI'].'" class="button">Ну и ок</a>';
            } else {              
          ?>
          <form action="page-cookies.php" method="post">
            <p class="form-group">
              <label for="username">Юзернейм:</label>
              <input type="text" class="form-control"  name="username" id="username" value="test">
            </p>
            <p class="form-group">
              <label for="password">Юзерпасс:</label>
              <input type="password" class="form-control"  name="password" id="password" value="test@djchsbch.com">
            </p>
            <p class="form-group">
              <button type="submit" class="btn submit">Отправить</button>
            </p>
          </form> 
          <?php 
            }
           ?>    
          </p>
        </div>
        <div class="box2">
          <h4><span class="icon icon-pencil"></span>Инфа для пользователя</h4>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere voluptate aliquam, aperiam recusandae. Excepturi velit, dolores eius incidunt! Deleniti, illo cumque reprehenderit modi vero! Repudiandae unde ipsum esse nesciunt asperiores?
          </p>
        </div>
      </div>
    </div>
  </div>
<?php 
  require 'footer.php' 
?>
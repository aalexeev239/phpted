<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PHPted</title>
  <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
  <!-- <link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
  <link href="css/fonts.css" rel="stylesheet" type="text/css" media="all" /> -->
  <link rel="stylesheet" href="css/style.css">

  <!--array([^[^]]*)><link href="default_ie6.css" rel="stylesheet" type="text/css" /><!array([^[^]]*)-->
</head>
<body>
  <div id="header-wrapper">
  <div id="header" class="container">
    <div id="menu">
      <ul>
        <?php 

          mb_internal_encoding('utf-8');

          $pages = array(
            array(
              url => 'index.php',
              title => 'Mainpage',
            ),
            array(
              url => 'page-forms.php',
              title => 'Forms',
            ),
            array(
              url => 'page-xml.php',
              title => 'XML',
            ),
            array(
              url => 'page-strings.php',
              title => 'Strings',
            ),
            array(
              url => 'page-cookies.php',
              title => 'Cookies',
            ),
            array(
              url => 'page-sessions.php',
              title => 'Sessions',
            ),
            array(
              url => 'page-databases.php',
              title => 'Databases',
            ),
            array(
              url => 'page-file.php',
              title => 'Files',
            ),
            array(
              url => 'page-markup.php',
              title => 'markup-template',
            ),
          );

          $cur_page_name = basename($_SERVER['PHP_SELF']);

          foreach ($pages as $value) {
            if ($value['url'] === $cur_page_name) {
              echo '<li class="current_page_item">';
            } else {
              echo '<li>';
            }

            echo '<a href="'.$value['url'].'" title="">'.$value['title'].'</a></li>';
          }


         ?>
      </ul>
    </div>
    <div id="logo">
      <h1><a href="index.php">PHPTED</a></h1>
      <span>The dark side</span></div>
  </div>
</div>
<?php 
  require 'header.php' 
?>
  <div id="wrapper1">
  <div id="welcome" class="container">
  <?php 

    //подключение к базе
    try {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=poloklinnik;charset=utf8', 'root', 'root');
        $pdo->setAttribute(
          PDO::ATTR_ERRMODE, 
          PDO::ERRMODE_EXCEPTION
        );
        
      } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage(); 
    }

    //схавали новости
    $content = file_get_contents("http://news.yandex.ru/travels.rss");
    // var_dump($content);
    $xml = new SimpleXMLElement($content);
    // var_dump($xml);

    //заранее подготовим все запросы, которые будем использовать в цикле
    //так будем вставлять в базу
    $stmt = $pdo->prepare('
      INSERT INTO yandex_travel (title, link, description, pubDate, guid)
      VALUES (:title, :link, :description, :pubDate, :guid);               
    ');

    //проверим есть ли элемент в базе
    $stmt2 = $pdo->prepare('
      SELECT guid FROM yandex_travel WHERE guid=:guid
    ');

    foreach ($xml->channel->item as $item) {

      $stmt2->bindParam(':guid', $item->guid);
      $stmt2->execute();

      //если не найден, то запишем новость в базу
      if (!$newsItem = $stmt2->fetch()) {
        
        //спешл формат для дат
        $dateTime = new DateTime($item->pubDate);

        $stmt->execute(array(
          ':title' => $item->title,
          ':link' => $item->link,
          ':description' => $item->description,
          ':pubDate' => $dateTime->format('Y-m-d h:i:s'),
          ':guid' => $item->guid,
        ));
      }
    }

    //выведем элементы на страницу
    $stmt = $pdo->prepare('
      SELECT title,link FROM yandex_travel ORDER BY pubDate DESC
    ');
    $stmt->execute();

    echo '<ol class="ol-page-xml">';
    //пока есть элементы, выводить ссылку на новость с правильным названием
    while ($newsItem = $stmt->fetch()) {
      echo '<li><a href="'.$newsItem['link'].'">'.$newsItem['title'].'</a></li>';
    }
    echo '</ol>';

   ?>

   <!-- <a href="roma.php">Рома подскажи</a> -->
 </div>
</div>
<?php 
  require 'footer.php' 
?>
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

    $stmt = $pdo->prepare('
      INSERT INTO yandex_travel (title, link, description, pubDate)
      VALUES (:title, :link, :description, :pubDate);               
    ');

    foreach ($xml->channel->item as $item) {
      // var_dump($item);      
      // echo $item->title.'<br>';

      $dateTime = new DateTime($item->pubDate);

      $stmt->execute(array(
        ':title' => $item->title,
        ':link' => $item->link,
        ':description' => $item->description,
        ':pubDate' => $dateTime->format('Y-m-d h:i:s'),
        ));
    }

   ?>
   <!-- <a href="roma.php">Рома подскажи</a> -->
 </div>
</div>
<?php 
  require 'footer.php' 
?>
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

    foreach ($xml->channel->item as $item) {
      // var_dump($item);      
      // echo $item->title.'<br>';

      $stmt = $pdo->prepare('
        INSERT INTO yandex_travel (title, link, description, pubDate)
        VALUES (:title, :link, :description, :pubDate);               
        ');

      // $stmt->bindParam(':name', $p_name);
      // $stmt->bindParam(':email', $p_email);
      // $stmt->bindParam(':sex', $p_sex);
      // $stmt->bindParam(':history', $p_history);
      // $stmt->bindParam(':insurance_num', $p_insurance_num);
      $stmt->execute(array(
        'title' => 'title',
        'link' => 'link',
        'description' => 'description',
        'pubDate' => 'pubDate',
        ));
    }

   ?>
   <!-- <a href="roma.php">Рома подскажи</a> -->
 </div>
</div>
<?php 
  require 'footer.php' 
?>
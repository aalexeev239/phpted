<?php 
  require 'header.php' 
?>
  <div id="wrapper1">
  <div id="welcome" class="container">
  <?php 
    $content = file_get_contents("http://news.yandex.ru/travels.rss");
    // var_dump($content);
    $xml = new SimpleXMLElement($content);
    // var_dump($xml);

    foreach ($xml->channel->item as $item) {
      // var_dump($item);      
      echo $item->title.'<br>';
    }
   ?>
   <!-- <a href="roma.php">Рома подскажи</a> -->
 </div>
</div>
<?php 
  require 'footer.php' 
?>
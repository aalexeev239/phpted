<?php 
  require 'header.php' 
?>

<div id="wrapper1">
  <div id="welcome" class="container">
    <div class="title">
      <h2>Шаманство с файлом</h2>
    <div class="content">
      <p>
      <?php 
        
        if ($dataString = file_get_contents('hipsta.txt')) {
          $strInput = explode("\n\n",$dataString);
          $strCount = count($strInput);
          $strOutput = [];
          for ($i=count($strInput)-1; $i >= 0 ; $i--) { 
            $strOutput[] = $strInput[$i]."\n\n";
          }
          $outStr = implode($strOutput);
          $file = "hipsta_o.txt";
          file_put_contents($file, $outStr);
        }
       ?>
      </p>
        <h2>Datetime</h2>
        <p>
          <?php 
            $bdate = '22.11.1968';
            $start = \DateTime::createFromFormat('d.m.Y', $bdate);
            $now = new DateTime();
            $diff = $now->diff($start);
            echo 'Start date: ' . $start->format('m/d/Y') . "\n";
            echo 'Now: ' . $now->format('m/d/Y') . "\n";
            echo 'Diff: ' . $diff->format('m/d/Y') . "\n";
           ?>
       </p>
    </div>
  </div>
</div>
<?php 
  require 'footer.php' 
?>
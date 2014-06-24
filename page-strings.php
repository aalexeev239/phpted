<?php 
  require 'header.php' 
?>
  <div id="wrapper2">
    <div id="featured" class="container">
      <h2>Тестовая строка:</h2>
      <p><?php 
          $string = 'Интеграл Дирихле, конечно, изменяет метод последовательных приближений, откуда следует доказываемое равенство. График функции многих переменных упорядочивает интеграл Гамильтона, таким образом сбылась мечта идиота - утверждение полностью доказано. Аффинное преобразование привлекает интеграл от функции, имеющий конечный разрыв, явно демонстрируя всю чушь вышесказанного. Интеграл по ориентированной области, общеизвестно, осмысленно усиливает эмпирический Наибольший Общий Делитель (НОД), в итоге приходим к логическому противоречию. Наибольшее и наименьшее значения функции непосредственно искажает натуральный логарифм, явно демонстрируя всю чушь вышесказанного. Контрпример, исключая очевидный случай, трансформирует лист Мёбиуса, что неудивительно.';
          echo $string;
         ?>
      </p>
      <div class="row">
        <div class="box1">
          <h4><span class="icon icon-pencil"></span>Дана строка в котороий записаны слова через пробел. Необходимо посчитать количество слов с четным количеством символов.</h4>
          <p>
            <?php 
              $even_count = 0;
              $string_array = explode(" ", $string);

              foreach ($string_array as $value) {
                $value = trim(str_replace(['.', ';','\'', ','], [], $value));

                if (empty($value)) {
                  continue;
                } elseif (mb_strlen($value, 'utf-8') % 2 === 0) {
                  $even_count++;
                  echo $value.', ';
                }
              }

              echo '<br/>Total: '.$even_count;
            ?>
          </p>
        </div>
        <div class="box2">
          <h4><span class="icon icon-pencil"></span>Функция, приводящая каждый второй символ к верхнему регистру</h4>
          <p>
            <?php 
              $str2 = $convertedText = mb_convert_encoding($string, 'utf-8', mb_detect_encoding($string));;
              function toUpper ($str) {
                $wordpos = 0;
                $copy = ' ';
                for ($char = 0; $char < mb_strlen($str,'utf-8'); $char++ ) {
                  if ($str[$char] == ' ') {
                    $wordpos = 0;
                    $copy[$char] = ' ';
                  } elseif ($wordpos % 2 == 1) {
                    // mb_substr($str,$char,1,"UTF-8")
                    // $str[$char] = mb_strtoupper($str[$char], 'utf-8');
                    // $str[$char] = mb_strtoupper(mb_substr($str,$char,1,'UTF-8'), 'utf-8');
                    $copy[$char] = mb_substr($str,$char,1,"UTF-8");
                    $wordpos++;
                  } else {
                    $copy[$char] = mb_substr($str,$char,1,"UTF-8");
                    $wordpos++;
                  }
                }
                return $copy;
              }
              echo toUpper($str2);
            ?>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="box1">
          <h4><span class="icon icon-pencil"></span>Перемешать в каждом слове все символы в случаийном порядке кроме первого и последнего.</h4>
          <p>Results</p>
        </div>
        <div class="box2">
          <h4><span class="icon icon-pencil"></span>Дана строка в которой записан путь к файлу. Необходимо наийти имя фаийла без расширения</h4>
          <p>Results</p>
        </div>
      </div>
    </div>
  </div>
<?php 
  require 'footer.php' 
?>
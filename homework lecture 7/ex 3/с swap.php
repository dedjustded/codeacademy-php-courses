<html>
<body>
<?php
$h = date('H');
switch (true) {
    case ($h >= 5 && $h < 12):
        $greeting = "Дубруютру";
      break;
    case ($h >= 12 && $h < 18):
        $greeting = "Добър ден";
      break;
    case ($h >= 18 && $h < 24):
        $greeding = "Добър вечер";
        break;
    default:
      $greeting = "Error 404 time space continuum broken";
      break;
    }
    echo $greeting;
?>
</body>
</html>
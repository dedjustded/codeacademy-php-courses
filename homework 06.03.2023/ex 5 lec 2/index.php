<html>
<body>
<?php
$sum = 0;
$count = 0;
$num = 0;

while ($count < 10) {
  if ($num % 2 == 0) {
    $sum += $num;
    $count++;
    echo "Четно число: " . $num . "<br>";
    $digits = str_split((string)$num);
    foreach ($digits as $digit) {
      echo $digit . " ";
    }
    echo "<br>";
  }
  $num++;
}

echo "Сумата на първите 10 четни числа е: " . $sum;
?>
</body>
</html>

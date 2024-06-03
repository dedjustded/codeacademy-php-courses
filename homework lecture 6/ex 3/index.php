<html>
<body>
<?php
$num = 12345;
$sum = 0;
$digits = array();

echo "Сумата на числата които съставят $num ";
do {
    $digit = $num % 10;
    $sum += $digit;
    array_unshift($digits, $digit);
    $num = intval($num / 10);
} while ($num > 0);
echo "е: " . $sum . "<br>";
echo "Числата които съставят главната цифра са:";
foreach ($digits as $digit) {
    echo " $digit ";
}

?>

</body>
</html>
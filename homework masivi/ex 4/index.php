<html>
<body>
<?php
function sumArray($array) {
    $sum = 0;
    $sumString = "";
    foreach ($array as $number) {
        $sum += $number;
        $sumString .= "$number+";
    }
    $sumString = rtrim($sumString, "+");
    return "$sumString = $sum";
}
$numbers = array(2, 4, 6, 8, 10);
echo sumArray($numbers);
?>
</body>
</html>
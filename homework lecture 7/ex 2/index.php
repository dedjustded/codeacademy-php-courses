<html>
<body>
<?php
$array = range(1, 20);
for ($i = 0; $i < count($array); $i++) {
    if ($array[$i] == 10) {
        continue;
    }
    if ($array[$i] % 2 == 0) {
        echo $array[$i] . "\n";
        if ($array[$i] == 20 || $array[$i] == 18 || $array[$i] == 16 || $array[$i] == 14 || $array[$i] == 12) {
            break;
        }
    }
}
?>
</body>
</html>
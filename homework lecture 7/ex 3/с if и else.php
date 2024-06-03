<html>
<body>
<?php
$h = date('H');
if ($h >= 0 && $h < 12) {
    echo "Дубру'ютру";
} elseif ($h >= 12 && $h < 18) {
    echo "Добър ден";
} elseif ($h >= 18 && $h < 24) {
    echo "Добър вечер";
} else {
    echo "Error 404 time space continuum broken";
}
?>
</body>
</html>
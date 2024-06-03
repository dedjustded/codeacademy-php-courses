<html>
<body>
<?php
$date = min(date('1'), 7); // insert day of week here, моля ползвайте от 1 до 7 цифри//
if ($date >= 1 && $date <= 5) {
    echo "Спорна работа! :("
} else {
    echo "Весел уикенд! :D"
}
?>


</body>
</html>
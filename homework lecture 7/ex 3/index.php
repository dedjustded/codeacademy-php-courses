<html>
<body>
<?php
$h = date('H');
if ($h >= 0 && $h < 12) {
    goto morning;
} elseif ($h >= 12 && $h < 18) {
    goto afternoon;
} elseif ($h >= 18 && $h < 24) {
    goto evening;
} else {
    goto invalid;
}
morning:
echo "Доброютру";
goto end;
afternoon:
echo "Добър ден";
goto end;
evening:
echo "Добър вечер";
goto end;
invalid:
echo "Error 404 time space continuum broken";
end:
?>
</body>
</html>
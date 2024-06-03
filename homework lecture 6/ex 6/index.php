<html>
<body>
<?php
$wholenum = 2563;
$string_num = (string) $wholenum;

for ($i = 0; $i < strlen($string_num); $i++) {
  echo $string_num[$i] . ", ";
}
?>
</body>
</html>
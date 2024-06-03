<html>
<body>
<?php
$month = 3;
$year = 2023;
$day = 1;
$numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
while ($day <= $numDays) {
 $date = strtotime("$year-$month-$day");
 $dayOfWeek = date('N', $date);
 $day++;
 if ($dayOfWeek >= 6) {
  continue;
 }
 echo date('Y-m-d', $date) . "\n";
}
?>

</body>
</html>
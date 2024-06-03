<?php
$date_string = "2023-04-04";
echo "$date_string беше преди: ";
$now = time();
$target_date = strtotime($date_string);
$diff_seconds = $now - $target_date;
define("SECONDS_IN_MINUTE", 60);
define("SECONDS_IN_HOUR", 3600);
define("SECONDS_IN_DAY", 86400);
define("SECONDS_IN_WEEK", 604800);
define("SECONDS_IN_MONTH", 2629800);
$diff_minutes = round($diff_seconds / SECONDS_IN_MINUTE);
$diff_hours = round($diff_seconds / SECONDS_IN_HOUR);
$diff_days = round($diff_seconds / SECONDS_IN_DAY);
$diff_weeks = round($diff_seconds / SECONDS_IN_WEEK);
$diff_months = round($diff_seconds / SECONDS_IN_MONTH);
if ($diff_months >= 2) {
    echo "Преди " . $diff_months . " месеца";
} elseif ($diff_weeks >= 2) {
    echo "Преди " . $diff_weeks . " седмици";
} elseif ($diff_days >= 2) {
    echo "Преди " . $diff_days . " дни";
} elseif ($diff_hours >= 2) {
    echo "Преди " . $diff_hours . " часа";
} elseif ($diff_minutes >= 2) {
    echo "Преди " . $diff_minutes . " минути";
} else {
    echo "... преди време";
}
?>

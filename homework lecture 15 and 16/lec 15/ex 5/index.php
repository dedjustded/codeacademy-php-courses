<?php
$dates = array(
    "2023-04-03",
    "2023-04-01",
    "2023-04-02");
$timestamps = array_map('strtotime', $dates);
sort($timestamps);
$sorted_dates = array_map(function($timestamp) {
    return date('Y-m-d', $timestamp);
}, $timestamps);
echo '<ul>';
foreach ($sorted_dates as $date) {
    echo '<li>' . $date . '</li>';
}
echo '</ul>';
?>


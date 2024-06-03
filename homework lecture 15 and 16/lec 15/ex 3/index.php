<?php
if (isset($_POST['month']) && isset($_POST['year'])) {
    $month = intval($_POST['month']);
    $year = intval($_POST['year']);
} else {
    $month = date('n');
    $year = date('Y');
}
$start_date = mktime(0, 0, 0, $month, 1, $year);
$end_date = mktime(0, 0, 0, $month + 1, 0, $year);

$current_date = $start_date;
$dates = array();
while ($current_date <= $end_date) {
    $dates[] = date('Y-m-d', $current_date);
    $current_date += 86400;
}
echo '<ul>';
foreach ($dates as $date) {
    echo '<li>' . $date . '</li>';
}
echo '</ul>';
?>
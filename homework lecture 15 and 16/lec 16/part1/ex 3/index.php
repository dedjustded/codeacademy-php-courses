<?php
$dates = [
    '2023-04-01',
    '2023-03-01',
    '2023-02-01',
    '2023-01-01'
];
function compare_dates($date1, $date2) {
    $datetime1 = DateTime::createFromFormat('Y-m-d', $date1);
    $datetime2 = DateTime::createFromFormat('Y-m-d', $date2);
    return $datetime1 <=> $datetime2;
}
usort($dates, 'compare_dates');
print_r($dates);
?>



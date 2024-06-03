<?php
$numbers = [-5, -2, 1, 4, 6];
function negativeToEndSort(array $numbers): array {
    $positive = [];
    $negative = [];
    foreach ($numbers as $number) {
        if ($number < 0) {
            $negative[] = $number;
        } else {
            $positive[] = $number;
        }
    }
    rsort($positive);
    return array_merge($positive, $negative);
}
$sorted = negativeToEndSort($numbers);
print_r($sorted);
?>



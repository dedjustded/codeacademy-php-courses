<?php
function sumDigits($n, &$digits = []) {
    if ($n == 0) {
        return array_sum($digits);
    }
    $lastDigit = $n % 10;
    $digits[] = $lastDigit;
    $remainingDigits = (int)($n / 10);
    return sumDigits($remainingDigits, $digits);
}

$digits = [];
$sum = sumDigits(12345, $digits);
echo implode("+", $digits) . " = " . $sum;
?>

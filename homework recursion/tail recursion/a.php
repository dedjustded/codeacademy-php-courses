<?php
function fibonaci($n, $prev1 = 0, $prev2 = 1) {
    if ($n == 0) {
        return $prev1;
    }
    if ($n == 1) {
        return $prev2;
    }
    return fibonaci($n - 1, $prev2, $prev1 + $prev2);
}
echo fibonaci(10);
?>

<?php
function fibonaci($n) {
    if ($n == 0 || $n == 1) {
        return $n;
    } else {
        return fibonaci($n - 1) + fibonaci($n - 2);
    }
}
echo fibonaci(5);
?>

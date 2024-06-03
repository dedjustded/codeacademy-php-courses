<?php
function countdigits($n) {
    if ($n < 10) {
        return 1;
    } else {
        return 1 + countdigits($n / 10);
    }
}
echo countdigits(3423242);
?>

<?php
function reverseString($str) {
    $len = strlen($str);
    if ($len == 0) {
        return;
    }
    $remaining = substr($str, 0, $len - 1);
    reverseString($remaining);
    echo $str[$len - 1];
}
    echo reverseString("be not afraid");
?>

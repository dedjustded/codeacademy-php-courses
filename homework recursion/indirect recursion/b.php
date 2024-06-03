<?php
$palindrome = "anna";
function isPalindrome($str) {
    $len = strlen($str);
    if ($len < 2) {
        return true;
    }
    if ($str[0] !== $str[$len-1]) {
        return false;
    }
    return isPalindrome(substr($str, 1, $len-2));
}
echo ("is $palindrome a palindrome : ");
echo isPalindrome($palindrome) ? 'yes' : 'no';
?>

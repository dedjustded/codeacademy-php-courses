<html>
<body>
    <?php
    function is_palindrome($str) {
        $str = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $str));
        return $str === strrev($str);
    }
    echo is_palindrome("Hello World"); // напиши нещо тук
    ?>
</body>
</html>
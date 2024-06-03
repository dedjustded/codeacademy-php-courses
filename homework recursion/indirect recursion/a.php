<?php
function foo() {
    static $counter = 0;
    if ($counter > 10) {
        return;
    }
    $counter++;
    echo "foo\n";
    bar();
}
function bar() {
    static $counter = 0;
    if ($counter > 10) {
        return;
    }
    $counter++;
    echo "bar\n";
    foo();
}
?>

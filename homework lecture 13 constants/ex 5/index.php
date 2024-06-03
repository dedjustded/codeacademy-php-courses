<?php
function alternator($x1, $x2) {
  static $count = 0;
  $count++;
  if ($count % 2 == 0) {
    return $x2;
  } else {
    return $x1;
  }
}
echo alternator("0", "1") . "<br>";
echo alternator("0", "1") . "<br>";
echo alternator("0", "1") . "<br>";
?>
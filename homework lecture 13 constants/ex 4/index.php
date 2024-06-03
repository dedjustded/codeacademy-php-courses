<?php
function factorial($num) { // локална променлива
    $result = 1;
    for ($i = 1; $i <= $num; $i++) {
      $result *= $i;
    }
    return $result;
}
echo factorial(5);

//-----------------------------------------------------------------------------------------------------------//
$result2 = 1; // глобална променлива
function factorial2($num) {
  global $result2;
  for ($i = 1; $i <= $num; $i++) {
    $result2 *= $i;
  }
}
factorial2(5);
echo $result2;
?>
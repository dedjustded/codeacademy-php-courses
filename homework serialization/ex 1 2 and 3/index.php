<?php
$fruits = array(
    "ябълки" => 2.50,
    "банани" => 1.50,
    "портокали" => 3.00,
    "круши" => 2.00,
    "ананаси" => 5.50
);
$serialized_fruits = serialize($fruits);
echo $serialized_fruits;
?>

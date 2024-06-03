<html>
<body>
<?php

$integer=1;
echo $integer." this is a ".gettype($integer)."<br>";
$float=1.54;
echo $float." this is a ".gettype($float)."<br>";
$boolean=true;
echo $boolean." is a ".gettype($boolean)." 1 means true, 0 means false" ."<br>";
$string="asdf123";
echo $string." this is a ".gettype($string)."<br>";
$array=array("1","2","3");
foreach($array as $printablearray)
echo $printablearray. " this is an " .gettype($array).PHP_EOL;
print_r( $array." this is a ".gettype($array)."<br>");

?>
</body>
</html>
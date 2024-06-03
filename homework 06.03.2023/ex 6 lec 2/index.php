<html>
<body>
<?php

$var1 = 1;
$var2 = 2;
$var3 = 3;
echo "unaltered variables: ";
print_r($var1);
echo " ";
print_r($var2);
echo " ";
print_r($var3);
echo " "."<br>";
echo "altered variables: ";
$var1 -= 1;
$var2 *= 2;
$var3 /= 3;
print_r($var1);
echo " ";
print_r($var2);
echo " ";
print_r($var3);
echo " ";

?>
</body>
</html>


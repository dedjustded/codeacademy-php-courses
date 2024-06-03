<!DOCTYPE html>
<html>
<?php
$numbers = range(1, 20);
$count = 0;

for ($i = 0; $i < count($numbers); $i++) {
    if ($numbers[$i] % 2 == 0) { 
        echo "$numbers[$i] \n";
        $count++;

        if ($count == 5) { 
            break;
        }
    }
}
?>

</body>
</html>
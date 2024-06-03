<?php
$names = array("kircho", "alex", "hristo", "plamen", "rusi", "zahari", "ivan" , "koleto", "Pavkata");
$N = 3;
while (!empty($names)) {
    if ($N <= count($names)) {
        $indices = array_rand($names, $N);
        echo "Team: ";
        foreach ($indices as $index) {
            echo $names[$index] . " ";
        }
        echo " " . PHP_EOL;
        foreach ($indices as $index) {
            unset($names[$index]);
        }
    } else {
        break;
    }
}
?>

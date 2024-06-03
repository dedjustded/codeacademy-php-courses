<?php
function generateTree($maxValue, $depth){
    if ($depth == 0) {
        return null;
    }
    $node = array(
        'value' => rand($maxValue, 1),
        'left' => generateTree($maxValue, $depth - 1),
        'right' => generateTree($maxValue, $depth - 1),
    );
    return $node;
}

function generateTreeWithException($maxValue, $depth) {
    if ($maxValue <= 0 || $depth <= 0) {
        throw new Exception("Invalid arguments");
    }
    return generateTree($maxValue, $depth);
}

try {
    $tree = generateTreeWithException(3, 100);
    echo "var_dump output:\n";
    var_dump($tree);
    echo "\nprint_r output:\n";
    print_r($tree);
    function getNodeBacktrace($node) {
        echo "Backtrace for node with value " . $node['value'] . ":\n";
        debug_print_backtrace();
        echo "\n";
    }
    getNodeBacktrace($tree['left']['right']);
} catch(Exception $e) {
    echo "Exception caught: " . $e->getMessage() . "\n";
}

?>


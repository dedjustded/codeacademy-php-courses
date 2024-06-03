<?php

$file = 'example.xml';
$xml = simplexml_load_file($file);
$tag_names = array();
foreach ($xml->xpath('//*') as $element) {
    $tag_name = $element->getName();
    if (!in_array($tag_name, $tag_names)) {
        $tag_names[] = $tag_name;
    }
}
sort($tag_names);
foreach ($tag_names as $tag_name) {
    echo $tag_name . "\n";
}

?>

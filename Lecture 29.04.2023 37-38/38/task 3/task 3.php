<?php

$xml = simplexml_load_file('example.xml');
$json = json_encode($xml);
file_put_contents('example.json', $json);

?>
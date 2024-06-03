<?php
$xmlFile = 'example.xml';
$xml = simplexml_load_file($xmlFile);
$json = json_encode($xml);
header('Content-Type: application/json');
echo $json;
?>

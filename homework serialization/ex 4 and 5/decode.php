<?php
$file = 'books.json';
$json = file_get_contents($file);
$books = json_decode($json, true);
var_dump($books);
?>

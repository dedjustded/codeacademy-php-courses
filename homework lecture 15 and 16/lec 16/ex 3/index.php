<?php
$text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
Donec http://example.com nec lacus eu dolor vehicula vulputate. 
Nullam https://www.google.com/search?q=regex velit tortor, consequat vel suscipit eu.";
$pattern = "/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/";
preg_match_all($pattern, $text, $matches);
$urls = $matches[0];
print_r($urls);
?>


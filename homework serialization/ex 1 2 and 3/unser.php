<?php
$text = 'a:5:{s:12:"ябълки";d:2.5;s:12:"банани";d:1.5;s:18:"портокали";d:3;s:10:"круши";d:2;s:14:"ананаси";d:5.5;}';
$fruit = unserialize($text);
var_dump($fruit);
?>

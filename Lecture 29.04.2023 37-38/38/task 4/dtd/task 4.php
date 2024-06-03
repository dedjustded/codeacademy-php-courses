<?php
libxml_use_internal_errors(true);
$xmlFile = 'example.xml';
$dtdFile = 'example.dtd';
$dom = new DOMDocument();
$dom->load($xmlFile);
if ($dom->validate()) {
  echo 'XML документът е валиден спрямо DTD файла.';
} else {
  echo 'XML документът не е валиден спрямо DTD файла.';
  $errors = libxml_get_errors();
  foreach ($errors as $error) {
    echo '<br>' . $error->message;
  }
  libxml_clear_errors();
}
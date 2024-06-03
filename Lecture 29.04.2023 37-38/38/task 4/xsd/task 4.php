<?php
libxml_use_internal_errors(true);
$xmlFile = 'example.xml';
$xsdFile = 'example.xsd';
$dom = new DOMDocument();
$dom->load($xmlFile);
if ($dom->schemaValidate($xsdFile)) {
  echo 'XML документът е валиден спрямо XSD файла.';
} else {
  echo 'XML документът не е валиден спрямо XSD файла.';
  $errors = libxml_get_errors();
  foreach ($errors as $error) {
    echo '<br>' . $error->message;
  }
  libxml_clear_errors();
}
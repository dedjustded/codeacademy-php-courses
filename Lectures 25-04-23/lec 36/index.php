<?php

require_once 'config/Config.php';
require_once 'config/exceptions/configexception.php';

$config = new Config();

$config->set('database.host', 'localhost');
$config->set('database.username', 'root');
$config->set('database.password', 'password');
$config->set('database.dbname', 'mydatabase');
$config->set('email

.smtp', 'smtp.gmail.com');
$config->set('email.port', '587');
$config->set('email.username', 'myemail@gmail.com');
$config->set('email.password', 'emailpassword');

try {
$config->saveToFile('config.json');
echo 'Config saved to file.';
} catch (ConfigException $e) {
echo 'Error saving config to file: ' . $e->getMessage();
}

try {
$config->loadFromFile('config.json');
echo 'Loaded config values:<br>';
echo 'Database host: ' . $config->get('database.host') . '<br>';
echo 'Database username: ' . $config->get('database.username') . '<br>';
echo 'Database password: ' . $config->get('database.password') . '<br>';
echo 'Database name: ' . $config->get('database.dbname') . '<br>';
echo 'Email SMTP: ' . $config->get('email.smtp') . '<br>';
echo 'Email port: ' . $config->get('email.port') . '<br>';
echo 'Email username: ' . $config->get('email.username') . '<br>';
echo 'Email password: ' . $config->get('email.password') . '<br>';
} catch (ConfigException $e) {
echo 'Error loading config from file: ' . $e->getMessage();
}

?>
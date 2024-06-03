<?php
class Database {
  private static $instance;

  private function __construct() {}

  public static function getInstance() {
    if (!self::$instance) {
      self::$instance = new PDO('mysql:host=localhost;dbname=mydb', 'username', 'password');
    }

    return self::$instance;
  }
}
?>

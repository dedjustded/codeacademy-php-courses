<html>
<body>
<?php
class User {
  private static $userCount = 0;
  private $name;
  
  public function __construct($name) {
      $this->name = $name;
      self::$userCount++;
  }
  
  public function getName() {
      return $this->name;
  }
  
  public static function getUserCount() {
      return self::$userCount;
  }
}

$user1 = new User("Иван");
$user2 = new User("Алекс");
$user3 = new User("Веско");

echo "Брой потребители: " . User::getUserCount() . "<br>";
echo "Име на потребител 1: " . $user1->getName() . "<br>";
echo "Име на потребител 2: " . $user2->getName() . "<br>";
echo "Име на потребител 3: " . $user3->getName() . "<br>";
?>
</body>
</html>
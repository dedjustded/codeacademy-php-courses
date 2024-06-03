<html>
<body>
<?php
class Car {
  private $make;
  private $model;
  private $year;
  private $color;
  private $isRunning;

  public function __construct($make, $model, $year, $color) {
    $this->make = $make;
    $this->model = $model;
    $this->year = $year;
    $this->color = $color;
    $this->isRunning = false;
  }

  public function start() {
    $this->isRunning = true;
    echo "Колата започна да работи.";
  }

  public function stop() {
    $this->isRunning = false;
    echo "Колата спря да работи.";
  }

  public function getMake() {
    return $this->make;
  }

  public function getModel() {
    return $this->model;
  }

  public function getYear() {
    return $this->year;
  }

  public function getColor() {
    return $this->color;
  }

  public function isRunning() {
    return $this->isRunning;
  }
}

$car1 = new Car("BMW", "X5", 2018, "черен");
echo "Марка: " . $car1->getMake() . "<br>";
echo "Модел: " . $car1->getModel() . "<br>";
echo "Година: " . $car1->getYear() . "<br>";
echo "Цвят: " . $car1->getColor() . "<br>";
$car1->start();
echo "<br>Колата работи: " . ($car1->isRunning() ? "да" : "не") . "<br>";
$car1->stop();
echo "Колата работи: " . ($car1->isRunning() ? "да" : "не");
?>
</body>
</html>
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

  public function setMake($make) {
    $this->make = $make;
  }

  public function getModel() {
    return $this->model;
  }

  public function setModel($model) {
    $this->model = $model;
  }

  public function getYear() {
    return $this->year;
  }

  public function setYear($year) {
    $this->year = $year;
  }

  public function getColor() {
    return $this->color;
  }

  public function setColor($color) {
    $this->color = $color;
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
$car1->setMake("Audi");
$car1->setModel("Q7");
$car1->setYear(2019);
$car1->setColor("син");
echo "Нова марка: " . $car1->getMake() . "<br>";
echo "Нов модел: " . $car1->getModel() . "<br>";
echo "Нова година: " . $car1->getYear() . "<br>";
echo "Нов цвят: " . $car1->getColor() . "<br>";
$car1->start();
echo "<br>Колата работи: " . ($car1->isRunning() ? "да" : "не") . "<br>";
$car1->stop();
echo "Колата работи: " . ($car1->isRunning() ? "да" : "не");
?>

</body>
</html>
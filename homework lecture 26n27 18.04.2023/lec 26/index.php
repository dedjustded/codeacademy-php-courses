<html>
<body>
<?php
class Vehicle {
  private $brand;
  private $model;
  private $year;
  private $color;

  public function __construct($brand, $model, $year, $color) {
    $this->brand = $brand;
    $this->model = $model;
    $this->year = $year;
    $this->color = $color;
  }

  public function getBrand() {
    return $this->brand;
  }

  public function setBrand($brand) {
    $this->brand = $brand;
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
}
class Car extends Vehicle {
  private $doors;
  private $trunkCapacity;

  public function __construct($brand, $model, $year, $color, $doors, $trunkCapacity) {
    parent::__construct($brand, $model, $year, $color);
    $this->doors = $doors;
    $this->trunkCapacity = $trunkCapacity;
  }

  public function getDoors() {
    return $this->doors;
  }

  public function setDoors($doors) {
    $this->doors = $doors;
  }

  public function getTrunkCapacity() {
    return $this->trunkCapacity;
  }

  public function setTrunkCapacity($trunkCapacity) {
    $this->trunkCapacity = $trunkCapacity;
  }
}
class Truck extends Vehicle {
  private $cargoCapacity;

  public function __construct($brand, $model, $year, $color, $cargoCapacity) {
    parent::__construct($brand, $model, $year, $color);
    $this->cargoCapacity = $cargoCapacity;
  }

  public function getCargoCapacity() {
    return $this->cargoCapacity;
  }

  public function setCargoCapacity($cargoCapacity) {
    $this->cargoCapacity = $cargoCapacity;
  }
}
class Motorcycle extends Vehicle {
  private $wheels;
  private $engineSize;

  public function __construct($brand, $model, $year, $color, $wheels, $engineSize) {
    parent::__construct($brand, $model, $year, $color);
    $this->wheels = $wheels;
    $this->engineSize = $engineSize;
  }

  public function getWheels() {
    return $this->wheels;
  }

  public function setWheels($wheels) {
    $this->wheels = $wheels;
  }

  public function getEngineSize() {
    return $this->engineSize;
  }

  public function setEngineSize($engineSize) {
    $this->engineSize = $engineSize;
  }
}
$car = new Car("Toyota", "Corolla", 2022, "blue", 4, 500);
$truck = new Truck("Volvo","FH16", 2019, "white", 10000);
$motorcycle = new Motorcycle("Honda", "Sportster", 2020, "black", 2, 1200);
echo "Car: " . $car->getBrand() . " " . $car->getModel() . " " . $car->getYear() . " " . $car->getColor() . " " . $car->getDoors() . " " . $car->getTrunkCapacity() . "\n";
echo "Truck: " . $truck->getBrand() . " " . $truck->getModel() . " " . $truck->getYear() . " " . $truck->getColor() . " " . $truck->getCargoCapacity() . "\n";
echo "Motorcycle: " . $motorcycle->getBrand() . " " . $motorcycle->getModel() . " " . $motorcycle->getYear() . " " . $motorcycle->getColor() . " " . $motorcycle->getWheels() . " " . $motorcycle->getEngineSize() . "\n";

?>
</body>
</html>
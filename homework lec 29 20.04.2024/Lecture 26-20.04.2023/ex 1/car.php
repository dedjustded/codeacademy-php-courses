<?php
class Car
{
    protected $brand;
    protected $model;
    protected $year;

    public function getBrand()
    {
        return $this->brand;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getYear()
    {
        return $this->year;
    }
}

class SportsCar extends Car
{
    private $maxSpeed;

    public function __construct($brand, $model, $year, $maxSpeed)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
        $this->maxSpeed = $maxSpeed;
    }

    public function getMaxSpeed()
    {
        return $this->maxSpeed;
    }
}
?>

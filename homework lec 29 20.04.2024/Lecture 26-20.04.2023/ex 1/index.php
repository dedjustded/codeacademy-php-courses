<?php
require_once 'person.php';
require_once 'calculator.php';
require_once 'car.php';
require_once 'bank.php';

$person = new Person();
$person->setName("admin");
$person->setAge(30);
$person->setEmail("admin@gmail.com");

$calculator = new Calculator();
$calculator->add(10);
$calculator->subtract(5);
$calculator->multiply(2);
$calculator->divide(4);
$currentValue = $calculator->getCurrentValue();

$sportsCar = new SportsCar("Ferrari", "488 GTB", 2022, 330);
$brand = $sportsCar->getBrand();
$model = $sportsCar->getModel();
$year = $sportsCar->getYear();
$maxSpeed = $sportsCar->getMaxSpeed();

$bankAccount = new BankAccount();
$bankAccount->deposit(1000);

?>


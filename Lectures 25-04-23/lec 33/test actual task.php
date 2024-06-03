<?php
abstract class Animal {
    abstract public function makeSound();
}
interface Jumpable {
    public function jump();
}
$animal1 = new class() extends Animal implements Jumpable {
    public function makeSound() {
        echo "Animal 1 is making a sound...";
    }

    public function jump() {
        echo "Animal 1 is jumping...";
    }
};
$animal2 = new class() extends Animal implements Jumpable {
    public function makeSound() {
        echo "Animal 2 is making a sound...";
    }

    public function jump() {
        echo "Animal 2 is jumping...";
    }
};
class MyAnimal extends get_class($animal2) { //нз защо ми бие грешка моля за помощ
    public function run() {
        echo "My animal is running...";
    }
}

$animal1->makeSound();
$animal1->jump();

$animal2->makeSound(); 
$animal2->jump();

$myAnimal = new MyAnimal();
$myAnimal->makeSound();
$myAnimal->jump();
$myAnimal->run();
?>

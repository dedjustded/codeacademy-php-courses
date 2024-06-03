<?php
/**
 * Клас, който представя котки
 */
class Cat {
  /**
   * @var string Името на котката
   */
  public $name;

  /**
   * Конструктор за класа Cat
   *
   * @param string $name Име на котката
   */
  public function __construct($name) {
    $this->name = $name;
  }

  /**
   * Връща името на котката
   *
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Казва "Мяу"
   *
   * @return void
   */
  public function meow() {
    echo "Мяу\n";
  }
}

// Използваме Reflection API, за да генерираме документация
$class = new ReflectionClass('Cat');
$docComment = $class->getDocComment();

echo $docComment;

<html>
<body>
<?php
class Calculator {
  public function add($a, $b) {
    return $a + $b;
  }

  public function subtract($a, $b) {
    return $a - $b;
  }

  public function multiply($a, $b) {
    return $a * $b;
  }

  public function divide($a, $b) {
    if ($b == 0) {
      throw new Exception("Деление на нула!");
    }
    return $a / $b;
  }
}

$calculator = new Calculator();

if (isset($_POST['a']) && isset($_POST['b'])) {
  $a = $_POST['a'];
  $b = $_POST['b'];

  echo "Събиране: " . $calculator->add($a, $b) . "<br>";
  echo "Изваждане: " . $calculator->subtract($a, $b) . "<br>";
  echo "Умножение: " . $calculator->multiply($a, $b) . "<br>";

  try {
    echo "Деление: " . $calculator->divide($a, $b) . "<br>";
  } catch (Exception $e) {
    echo $e->getMessage();
  }
}
?>

<form method="post">
  a: <input type="text" name="a"><br>
  b: <input type="text" name="b"><br>
  <input type="submit" value="Изчисли">
</form>

</body>
</html>
<!DOCTYPE html>
<html>
<?php
if(isset($_POST['date1']) && isset($_POST['date2'])){
  $date1 = $_POST['date1'];
  $date2 = $_POST['date2'];
  if(!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $date1) || !preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $date2)){
    echo "Невалиден формат";
    exit();
  }
  if(strtotime($date1) === false || strtotime($date2) === false){
    echo "Грешка, пробвай пак";
    exit();
  }
  $seconds_diff = strtotime($date2) - strtotime($date1);
  $days_diff = floor($seconds_diff / 86400);

  echo "Разликата между $date1 и $date2 е: $days_diff дни";
}
?>
<form method="post">
  <label for="date1">Дата 1 (във формат YYYY-MM-DD):</label>
  <input type="text" name="date1" id="date1"><br>

  <label for="date2">Дата 2 (във формат YYYY-MM-DD):</label>
  <input type="text" name="date2" id="date2"><br>

  <input type="submit" value="Изчисли">
</form>
</body>
</html>
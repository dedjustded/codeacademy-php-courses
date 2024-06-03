<?php
if (isset($_POST['number'], $_POST['min'], $_POST['max'])) {
  $number = intval($_POST['number']);
  $min = intval($_POST['min']);
  $max = intval($_POST['max']);
  $inclusive = isset($_POST['inclusive']);
  if ($number >= $min) {
    echo '<p>Числото ' . $number . ' е по-голямо или равно на ' . $min . '.</p>';
  } else {
    echo '<p>Числото ' . $number . ' е по-малко от ' . $min . '.</p>';
  }
  if ($number <= $max) {
    echo '<p>Числото ' . $number . ' е по-малко или равно на ' . $max . '.</p>';
  } else {
    echo '<p>Числото ' . $number . ' е по-голямо от ' . $max . '.</p>';
  }
  if ($inclusive) {
    if ($number >= $min && $number <= $max) {
      echo '<p>Числото ' . $number . ' попада в диапазона [' . $min . ', ' . $max . '].</p>';
    } else {
      echo '<p>Числото ' . $number . ' не попада в диапазона [' . $min . ', ' . $max . '].</p>';
    }
  } else {
    if ($number > $min && $number < $max) {
      echo '<p>Числото ' . $number . ' попада в диапазона (' . $min . ', ' . $max . ').</p>';
    } else {
      echo '<p>Числото ' . $number . ' не попада в диапазона (' . $min . ', ' . $max . ').</p>';
    }
  }
  if ($inclusive) {
    $regex = '/^(?:' . $min . '|' . ($min+1) . '|[1-9][0-9]{0,' . (strlen($number)-1) . '}[0-9]*|' . ($max-1) . '|' . $max . ')$/';
  } else {
    $regex = '/^(?:' . ($min+1) . '|[1-9][0-9]{0,' . (strlen($number)-1) . '}[0-9]*|' . ($max-1) . ')$/';
  }
  echo '<p>Регулярен израз: ' . $regex . '</p>';
  if (preg_match($regex, $number)) {
    echo '<p>Числото ' . $number . ' пасва на регулярния израз.</p>';
    } else {
    echo '<p>Числото ' . $number . ' не пасва на регулярния израз.</p>';
    }
    }
    include 'form.php';
    ?>

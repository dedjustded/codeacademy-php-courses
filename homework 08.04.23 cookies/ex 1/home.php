<!DOCTYPE html>
<html>
<body>
<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}
if (isset($_POST['logout'])) {
  session_unset();
  session_destroy();
  setcookie('session_id', '', time() - 3600, '/', '', true, true);
  header('Location: login.php');
  exit;
  }
  echo 'Здравейте, ' . $_SESSION['username'] . '!';
  ?>
  <form method="post">
    <input type="submit" name="logout" value="Излизане">
  </form>

<?php
session_start();
if (isset($_SESSION['username'])) {
  header('Location: home.php');
  exit;
}
$valid_credentials = [
  "kircho" => "12121212Abv",
  "admin" => "admin",
  "koleto" => "123"
];
if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  if (array_key_exists($username, $valid_credentials) && $valid_credentials[$username] === $password) {
    session_regenerate_id(true);
    $_SESSION['username'] = $username;
    $session_id = session_id();
    setcookie('session_id', $session_id, 0, '/', '', true, true);
    header('Location: home.php');
    exit;
  } else {
    $error_message = "Грешно потребителско име или парола.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
</head>
<body>
  <h1>Вход</h1>
  <?php if (isset($error_message)): ?>
    <p><?php echo $error_message; ?></p>
  <?php endif; ?>
  <form method="post">
    <label>
      Потребителско име:
      <input type="text" name="username">
    </label>
    <br>
    <label>
      Парола:
      <input type="password" name="password">
    </label>
    <br>
    <input type="submit" value="Вход">
  </form>
</body>
</html>
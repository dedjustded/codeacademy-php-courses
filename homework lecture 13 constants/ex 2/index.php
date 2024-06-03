<!DOCTYPE html>
<html>
<head>
	<title>test</title>
</head>
<body>
	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$name = $_POST["name"];
			$email = $_POST["email"];
			$age = $_POST["age"];
			echo "<h2>Login details:</h2>";
			echo "Име: " . $name . "<br>";
			echo "Имейл: " . $email . "<br>";
			echo "Възраст: " . $age . "<br>";
		}
	?>
	<h2>Въведете информацията си:</h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label for="name">Име:</label>
		<input type="text" id="name" name="name"><br>
		<label for="email">Имейл:</label>
		<input type="email" id="email" name="email"><br>
		<label for="age">Възраст:</label>
		<input type="number" id="age" name="age"><br>
		<input type="submit" value="Изпрати">
	</form>
</body>
</html>
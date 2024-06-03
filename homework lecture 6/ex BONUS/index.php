<!DOCTYPE html>
<html>
<head>
	<title>Въведете число между 1 и 10</title>
</head>
<body>
	<form method="post">
		<label>Въведете число между 1 и 10:</label>
		<input type="number" name="number"> <!-- наскоро открих че може и да добавим min="цифра" max="цифра" за да може по директно юзъра да не може да слага числа по големи или по малки от тези които искаме-->
		<input type="submit" name="submit" value="Изпрати">
	</form>

	<?php
	if (isset($_POST['submit'])) {
		$number = $_POST['number'];

		do {
			if ($number < 1 || $number > 10) {
				echo "<p>Това не е между 5 и 10 :| моля пробвайте отново<p>";
				break;
			}

			echo "<p>Числото което избрахте е: $number <br> Това е валидно число<p>";
			break;
		} while (true);
	}
	?>
</body>
</html>
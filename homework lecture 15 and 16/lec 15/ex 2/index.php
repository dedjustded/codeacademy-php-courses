<!DOCTYPE html>
<html>
<head>
	<title>test1</title>
</head>
<body>
	<h1>test1</h1>
	<form action="" method="post">
		<label for="date">моля въведете дата:</label>
		<input type="text" name="date" id="date">
		<br>
		<label for="format">моля изберете формат:</label>
		<select name="format" id="format">
			<option value="d/m/Y">DD/MM/YYYY</option>
			<option value="m/d/Y">MM/DD/YYYY</option>
			<option value="Y-m-d H:i:s">YYYY-MM-DD HH:MM:S</option>
		</select>
		<br>
		<input type="submit" value="Преобразувай">
	</form>

	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$date = $_POST['date'];
		$format = $_POST['format'];
		$timestamp = strtotime($date);
		if (!$timestamp) {
			echo '<p style="color: red;">Грешка</p>';
		} else {
			$formatted_date = date($format, $timestamp);
			echo "<p>$formatted_date</p>";
		}
	}
	?>
</body>
</html>
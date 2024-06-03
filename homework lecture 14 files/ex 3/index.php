<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>test 3</title>
</head>
<body>
	<h1>test 3</h1>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<label for="filename">file name:</label>
		<input type="text" name="filename" id="filename">
		<br>
		<label for="filepath">file path:</label>
		<input type="text" name="filepath" id="filepath">
		<br>
		<label for="text">add whatever:</label>
		<br>
		<textarea name="text" id="text" rows="10" cols="50"></textarea>
		<br>
		<input type="submit" value="Добави текст">
	</form>
	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$filename = $_POST['filename'];
		$filepath = $_POST['filepath'];
		$text = $_POST['text'];
		$file = fopen($filepath . $filename, "a");
		if ($file) {
			fwrite($file, $text);
			fclose($file);
			echo "success!";
		} else {
			echo "error plz call me";
		}
	}
	?>
</body>
</html>
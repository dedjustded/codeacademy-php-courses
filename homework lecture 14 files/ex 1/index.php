<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>test</title>
</head>
<body>
	<h1>test</h1>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<label for="filename">name:</label>
		<input type="text" name="filename" id="filename">
		<br>
		<label for="filepath">filepath:</label>
		<input type="text" name="filepath" id="filepath">
		<br>
		<input type="submit" value="choose">
	</form>
	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$filename = $_POST['filename'];
		$filepath = $_POST['filepath'];
		$file = fopen($filepath . $filename, "r");
		if ($file) {
			echo "<h2>content:</h2>";
			echo "<pre>";
			echo fread($file, filesize($filepath . $filename));
			echo "</pre>";
			fclose($file);
		} else {
			echo "error, pls contact me";
		}
	}
	?>
</body>
</html>
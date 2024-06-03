<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>test2</title>
</head>
<body>
	<h1>test2</h1>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<label for="filename">name:</label>
		<input type="text" name="filename" id="filename">
		<br>
		<label for="filepath">filepath:</label>
		<input type="text" name="filepath" id="filepath">
		<br>
		<label for="content">write something:</label>
		<br>
		<textarea name="content" id="content" rows="10" cols="50"></textarea>
		<br>
		<input type="submit" value="submit">
	</form>
	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$filename = $_POST['filename'];
		$filepath = $_POST['filepath'];
		$content = $_POST['content'];
		$file = fopen($filepath . $filename, "w");
		if ($file) {
			fwrite($file, $content);
			fclose($file);
			echo "success!";
		} else {
			echo "error plz contact me";
		}
	}
	?>
</body>
</html>
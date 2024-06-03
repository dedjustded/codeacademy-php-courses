<<?php

define('UPLOAD_DIR', 'files/');

if (isset($_POST['upload'])) {
	$file = $_FILES['my_filename'];
	if (!is_uploaded_file($file['tmp_name'])) {
		echo 'File is not uploaded or corrupted!';
		echo build_file_upload_form();
		exit();
	}
	if (!file_exists(UPLOAD_DIR)) {
		mkdir(UPLOAD_DIR);
	}
	echo 'uploading...'.$file['tmp_name'] . ' => '. UPLOAD_DIR . $file['name'];

	move_uploaded_file($file['tmp_name'], UPLOAD_DIR . $file['name']);
	// $content = file_get_contents($file['tmp_name']); 
	// file_put_contents(UPLOAD_DIR . $file['name'], $content);

	echo 'Done.';
} else {
	echo build_file_upload_form();
}

function build_file_upload_form() {
	return <<<HTML

<form method="post" enctype="multipart/form-data">
	<label>Please select file to upload: </label><input type="file" name="my_filename" />
	<input type="submit" name="upload" value="Upload" />
</form>
HTML;

}
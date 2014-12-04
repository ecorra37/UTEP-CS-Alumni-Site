<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name 	= $_FILES["file"]['name'];
	$temp 	= $_FILES["file"]['tmp_name'];// Create a temporary file name:
	if (isset($name)){
		if (!empty($name)){
			if (move_uploaded_file($temp, 'tmp\\'.$name)) {//move_uploaded($old_loc, $new_loc)
				echo 'The file has been uploaded!<br>';
				//$name = $_FILES['file']['name'];
			} 
			else { // Couldn't move the file over.
				echo 'The file could not be moved.<br>';
			}
		}
		else { // No uploaded file.
			echo 'No file was uploaded.';
			$name = NULL;
		}
	}
	else echo 'Please, choose a file<br>';
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Upload pic.</title>
	</head>
	<body>
		<form action='upload_file_to_tmp.php' method='POST' enctype="multipart/form-data">
			<input type='file' name='file' id='file'>
			<input type='submit' value='Click to submit file!'>
		</form>
	</body>
</html>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		//variables needed to process the file upload
		$name 	= $_FILES["file"]['name'];//$_GET			//will store the actual name
		$temp	= $_FILES["file"]['tmp_name']; 				//C:\Windows\Temp
		
		//it will store a image into users..
		if ($name){
			$db = "cs5995team9fa14";
			require('mysqli_con.php');
			$query	= "UPDATE users SET profile_pic='$name' where user_id='$login_user'";//change $login_user for 2.
			$result = mysqli_query($con, $query);
			if ($result) {
				echo "New image stored in the database successfully<br>";
			} 
			else echo "Error: image could not be inserted into database.<br>";
		}
		else "No picture selected!<br>";
				
		//upload file from C:\Windows\Temp\ to C:\inetpub\wwwroot\tmp
		$location	= 'tmp\\'; 
		if(move_uploaded_file($temp,$location.$name)){
			echo'<span style="color:green">Image uploaded to folder tmp!</span><br>';
		}
		else {echo '<span style="color:red">Image not uploaded to folder tmp</span><br>';}
		mysqli_close($con);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Upload pic.</title>
	</head>
	<body>
		<form action='ajax_upload.php' method='POST' enctype="multipart/form-data" target='_blank'>
			<input type='file' name='file' id='file'>
			<input type='submit' value='Click to submit file!'>
		</form>
	</body>
</html>

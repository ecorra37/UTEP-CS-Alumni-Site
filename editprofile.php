<?php
	include('include/db.php');
	include('include/dbEC.php');
	session_start();

	if(!$configSite->Checklogin()){
		$configSite->redirectToURL("./access_denied.php");
	}

	($configSite->userName() == NULL) ? $login_user = " no username" : $login_user = $configSite->userName();
?>

<!DOCTYPE html>
<html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Alumni Website</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/main.css">
		<script src="js/main.js" ></script>
	</head>
	
	<body>
		<div id="navigation_container">
			<?php include './menu.php';?>
		</div>
		
		<div id="pageMiddle">
			<?php 
				echo "<h4>Edit or Update Account</h4></br>";

				$queryselect="SELECT * FROM users WHERE username='$login_user'";

				$result = mysqli_query($con,$queryselect);

				$row = mysqli_fetch_assoc($result);

				$email   = $row['email'];
				$fname   = $row['first'];
				$lname   = $row['last'];
				$title   = $row['title'];
				$gender  = $row['gender'];
				$city    = $row['city'];
				$address = $row['address'];
				$bio     = $row['bio_data'];
				$emp     = $row['employed'];
			?>

			<div class="reg-container">
				<form action="edituser.php" name="register" method="post">
					<div>
						User Name:<input type="" name="username" id="username" value="<?php echo "$login_user"?>" readonly/> (Read Only)
					</div>
					
					<div>
						Email:<input type="text" name="email" id="email" value="<?php echo "$email"?>" />
					</div>
					
					<div>
						First Name:<input type="text" name="fname" id="fname" value="<?php echo "$fname"?>" />
					</div>
					
					<div>
						Last Name:<input type="text" name="lname" id="lname" value="<?php echo "$lname"?>"/>
					</div>

					<div>
						Title:
						<?php
							if (strcasecmp($title, "Mr") == 0){
								echo "<td><input type='radio' name='title' value='Mr'checked> Mr <input type='radio' name='title' value='Mis' > Miss  <input type='radio' name='title' value='Ms'> Ms </td>";
							} else if(strcasecmp($title, "Mis") == 0){
								echo "<td><input type='radio' name='title' value='Mr'> Mr <input type='radio' name='title' value='Mis' checked> Miss  <input type='radio' name='title' value='Ms'> Ms </td>";
							} else {
								echo "<td><input type='radio' name='title' value='Mr'> Mr <input type='radio' name='title' value='Mis' checked> Miss <input type='radio' name='title' value='Ms' checked> Ms </td>";
							}
						?>
					</div>

					<div>
						Gender:
						<?php
							if (strcasecmp($gender, "m") == 0){
								echo "<td><input type='radio' name='gender' value='m' checked> Male <input type='radio' name='gender' value='f'> Female <input type='radio' name='gender' value='u'> NA </td>";
							} else if(strcasecmp($gender, "f") == 0) {
								echo "<td><input type='radio' name='gender' value='m'> Male <input type='radio' name='gender' value='f' checked> Female <input type='radio' name='gender' value='u'> NA </td>";
							} else {
								echo "<td><input type='radio' name='gender' value='m' > Male <input type='radio' name='gender' value='f'> Female <input type='radio' name='gender' value='u' checked> NA </td>";	
							}
						?>
					</div>

					<div>
						City:<input type="text" name="city" id="city" value="<?php echo "$city"?>"/>
					</div>
					
					<div>
						Address:<textarea name="address"><?php echo "$address"?></textarea>
					</div>

					<div>
						Bio Data:<textarea name="bio"><?php echo "$bio"?></textarea>
					</div>

					<div>
						Employeement Status:
						<?php
							if (strcasecmp($emp, "y") == 0){
								echo "<td><input type='radio' name='emp' value='y' checked> Yes <input type='radio' name='emp' value='n' > No <input type='radio' name='emp' value='u'> NA</td>";
							} else if(strcasecmp($emp, "n") == 0){
								echo "<td><input type='radio' name='emp' value='y' > Yes <input type='radio' name='emp' value='n' checked > No <input type='radio' name='emp' value='u'> NA</td>";
							} else {
								echo "<td><input type='radio' name='emp' value='y' > Yes <input type='radio' name='emp' value='n' > No <input type='radio' name='emp' value='u' checked> NA</td>";
							}
						?>
					</div>

					<div>				
						<button type="submit" id="edit" name="edit_submit">Update</button>
					</div>
				</form>
			</div>
			
			<hr />
			<h4>Upload your profile pic</h4>
			<form action="upload_photo.php" method="post" enctype="multipart/form-data">
				Select image to upload:
				<input type="file" name="fileToUpload" id="fileToUpload"><br/>
				<input type="submit" value="Upload Image" name="submit">
			</form>
			<hr />
		</div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
		<script src="js/plugins.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>
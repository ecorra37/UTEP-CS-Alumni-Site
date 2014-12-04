<?php
	session_start();
	include('include/db.php');
	
	$uname = (isset($_POST['username']) ? $_POST['username'] : null);
	$pwd = (isset($_POST['password']) ? $_POST['password'] : null);
	$username = sanitizeString($uname);
	$password = sanitizeString($pwd);
	$_SESSION['login_user'] = $username;

	// case for login                 
	if(isset($_POST['login_submit'])){
		if(ctype_alnum($username)){
			//check user exist

			$query = "SELECT username, first FROM users WHERE username='$username'and password='$password'";

			$result = mysqli_query($con,$query);
			$count = mysqli_num_rows($result);

			if($count == 1){
				$get = mysqli_fetch_assoc($result);
				
				$firstname = $get['first_name'];
				//echo "user exist";
				$_SESSION['login_user_fname'] = $firstname;
				$_SESSION['login_status'] = true;
				header("Location: loginprofile.php");
			} else {
				//user not exist invalud login credentials
				//echo "<meta http-equiv=\"refresh\" content=\"0; url=http://localhost/alumni/index.html\">";
				header("Location: index.php");
				exit();
			}
		}
	}

	// function to sanitize the user input
	function sanitizeString($var){
		$var = stripcslashes($var);
		$var = strip_tags($var);
		$var = htmlentities($var);
		return $var;
	}
?>
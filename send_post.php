<?php
	include('include/dbEC.php');
	include('include/db.php');
	/*session_start();

	isset($_SESSION['login_user']) ? $username = $_SESSION['login_user'] : header ("Location: access_denied.php");*/
	
	if(!$configSite->Checklogin()){
		$configSite->redirectToURL("./access_denied.php");
	}
	
	($configSite->userName() == NULL) ? $username = " no username" : $username = $configSite->userName();

	echo "$post";
	if($post != ""){
		$date_added = date("y-m-d");
		$added_by = $_SESSION['login_user'];
		$user_posted_to = $_SESSION['profile_user'];
		//echo "before insert";
		$postquery= "INSERT INTO user_posts values('','$post','$added_by','$user_posted_to', '$date_added')";
		//$queryselect="SELECT * FROM users WHERE email='$email'";

		$result = mysqli_query($con, $postquery);
	} else {
		echo "You must enter something in the post field before you can send it...";	
	}
?>
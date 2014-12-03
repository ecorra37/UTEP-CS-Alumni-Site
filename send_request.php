<?php
	include('include/dbEC.php');
	include('include/db.php');
	/*session_start();

	isset($_SESSION['login_user']) ? $username = $_SESSION['login_user'] : header ("Location: access_denied.php");*/
	
	if(!$configSite->Checklogin()){
		$configSite->redirectToURL("./access_denied.php");
	}
	
	($configSite->userName() == NULL) ? $username = " no username" : $username = $configSite->userName();

	$request_date = date("y-m-d");
	$user_id_from = $_SESSION['login_user'];
	$user_id_to = $_SESSION['profile_user'];
	//echo "before insert";
	$postquery = "INSERT INTO friend_requests values('','$user_id_from','$user_id_to','$request_date', '','0')";
	//$queryselect="SELECT * FROM users WHERE email='$email'";

	$result = mysqli_query($con, $postquery);
	if($result){
		echo "record inserted";	
	} else {
		echo "Error...";	
	}
?>
<?php
	include('include/db.php');
	include('include/dbEC.php');

	if(!$configSite->Checklogin()){
		$configSite->redirectToURL("./access_denied.php");
	}

	($configSite->userName() == NULL) ? $login_user = " no username" : $login_user = $configSite->userName();

	// TODO need to chekc for all users wrking only for last request	
	// list($stat, $user_from) = split("/ ", $_POST['accept']);
	$user_from = $_POST['accept'];
	list($stat, $user_from) = explode(" ", $user_from);

	// $user_from=$_POST['reject'];

	$frnd_status = "false";
	if(isset($_POST['accept'])){
		$date_added = date("y-m-d");

		$queryselect = "UPDATE friend_requests SET request_status='1', request_confirm_date='$date_added' WHERE user_id_to='$user_from' and user_id_from='$login_user'";

		$result = mysqli_query($con, $queryselect);

		if($result){
			// echo "$user_from is your friend now";
			$frnd_status = "true";
			header("Location: loginprofile.php?frnd_status=".$frnd_status);
		} else {
			echo "Problem with updation. Please try again";
		}
	}
?> 
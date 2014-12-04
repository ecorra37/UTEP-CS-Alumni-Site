<?php
	include('include/db.php');
	include('include/dbEC.php');
	session_start();

	if(!$configSite->Checklogin()){
		$configSite->redirectToURL("./access_denied.php");
	}

	($configSite->userName() == NULL) ? $login_user = " no username" : $login_user = $configSite->userName();

	if(isset($_POST['profile_settings'])){
		$property_name = (isset($_POST['profile_settings']) ? $_POST['profile_settings'] : null);
		$hide_status = (isset($_POST['hide_status']) ? $_POST['hide_status'] : null);
		list($stat, $property_name) = explode(" ", $property_name);
		echo $property_name;
		echo $hide_status;
		$date_added = date("y-m-d");

		if($hide_status=='on'){
			$queryselect= "UPDATE privacy SET hide_status='on',date_updated='$date_added' WHERE user_name='$login_user' and property_name='$property_name'";
		} else {
			//$hide_status=='off';
			$queryselect= "UPDATE privacy SET hide_status='off',date_updated='$date_added' WHERE user_name='$login_user' and property_name='$property_name'";
		}

		echo "before update<br/>";
		$result = mysqli_query($con,$queryselect);
		if($result){
			//echo "record updated succesfully<br/>";
			$privacy_update = "true";
			header("Location: loginprofile.php?privacy_update=".$privacy_update);
		} else {
			//echo "Problem with updation. Please try again<br/>";
			$privacy_update = "false";
			header("Location: loginprofile.php?privacy_update=".$privacy_update);
		}
	}
?>
<?php
	include('include/dbEC.php');
	include('include/db.php');
	/*session_start();

	isset($_SESSION['login_user']) ? $login_user = $_SESSION['login_user'] : header ("Location: access_denied.php");*/
	
	if(!$configSite->Checklogin()){
		$configSite->redirectToURL("./access_denied.php");
	}
	
	($configSite->userName() == NULL) ? $login_user = " no username" : $login_user = $configSite->userName();

	$email	 = $_POST['email'];
	$fname   = $_POST['fname'];
	$lname   = $_POST['lname'];        
	$title   = $_POST['title'];
	$gender  = $_POST['gender'];
	$city    = $_POST['city'];  
	$address = $_POST['address'];
	$bio     = $_POST['bio'];
	$emp     = $_POST['emp'];

	$act_update = "false";	 

	echo "$fname";

	if(isset($_POST['edit_submit'])){
		$queryselect= "UPDATE users SET email='$email',first='$fname',last='$lname',title='$title',gender='$gender',city='$city',address='$address',bio_data='$bio',employed='$emp' WHERE username='$login_user'";

		echo "before update";
		$result = mysqli_query($con,$queryselect);

		if($result){
			//echo "record updated succesfully";
			$act_update = "true";
			header("Location: loginprofile.php?act_update=".$act_update);
		} else {
			echo "Problem with updation. Please try again";
			$act_update = "false";
			header("Location: loginprofile.php?act_update=".$act_update);
		}
	}
?>
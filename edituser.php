<?php
	include('include/db.php');
	include('include/dbEC.php');
	session_start();

	if(!$configSite->Checklogin()){
		$configSite->redirectToURL("./access_denied.php");
	}

	($configSite->userName() == NULL) ? $login_user = " " : $login_user = $configSite->userName();
	
	$email	=sanitizeString($_POST['email']);
	$fname =sanitizeString($_POST['fname']);
	$lname =sanitizeString($_POST['lname']);        
	$title=sanitizeString($_POST['title']);
	$gender =sanitizeString($_POST['gender']);
	$city =sanitizeString($_POST['city']);  
	$address=sanitizeString($_POST['address']);
	$bio=sanitizeString($_POST['bio']);
	$emp=sanitizeString($_POST['emp']);

	$act_update = "false";	 

	echo "$fname";

	if(isset($_POST['edit_submit']))
	{      

	$queryselect= "UPDATE users SET email='$email',first='$fname',last='$lname',title='$title',gender='$gender',city='$city',address='$address',bio_data='$bio',employed='$emp' WHERE username='$login_user'";


	$result=mysqli_query($con,$queryselect);

	if($result)
	{
	//echo "record updated succesfully";
	$act_update = "true";
	header("Location: loginprofile.php?act_update=".$act_update);
	}
	else 

	{
	echo "Problem with updation. Please try again";
	$act_update = "false";
	header("Location: loginprofile.php?act_update=".$act_update);
	}
	}

	// function to sanitize the user input
	function sanitizeString($var)
	{
	$var=  stripcslashes($var);
	$var=  strip_tags($var);
	$var=  htmlentities($var);
	return $var;
	}
?>
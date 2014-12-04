<meta http-equiv="refresh" content="2; .php">

<?php 
session_start();
include('include/db.php');
include('include/dbEC.php');

if(!$configSite->Checklogin()){
		$configSite->redirectToURL("./access_denied.php");
	}
	
	($configSite->userName() == NULL) ? $login_user = " " : $login_user = $configSite->userName();


$post = (isset($_POST['addFriend']) ? $_POST['addFriend'] : null);

$request_date = date("y-m-d");
$user_id_from =$login_user;
$user_id_to =$_SESSION['profile_user'];
	//echo "before insert";
	$postquery= "insert into friend_requests values('','$user_id_from','$user_id_to','$request_date', '','0')";
    //$queryselect="SELECT * FROM users WHERE email='$email'";
     
    $result=mysqli_query($con,$postquery);
if($result){
	//echo "record inserted";
	
	 $f_status = "true";
        header("Location: loginprofile.php?f_status=".$f_status);
} else {	
//echo "Error...";
$f_status = "false";
        header("Location: loginprofile.php?f_status=".$f_status);	
}
?>
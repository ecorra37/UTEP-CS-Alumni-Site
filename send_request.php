<?php 
session_start();
include('include/db.php');

$post = (isset($_POST['addFriend']) ? $_POST['addFriend'] : null);

$request_date = date("y-m-d");
$user_id_from =$_SESSION['login_user'];
$user_id_to =$_SESSION['profile_user'];
	//echo "before insert";
	$postquery= "insert into friend_requests values('','$user_id_from','$user_id_to','$request_date', '','0')";
    //$queryselect="SELECT * FROM users WHERE email='$email'";
     
    $result=mysqli_query($con,$postquery);
if($result){
	echo "record inserted";	
} else {	
echo "Error...";	
}
?>
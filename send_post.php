<?php 
	session_start();
	include('includes/dbcon.php');

	$post = (isset($_POST['post']) ? $_POST['post'] : null);
	echo "$post";
	if($post!="")
	{
		$date_added = date("y-m-d");
		$added_by =$_SESSION['login_user'];
		$user_posted_to =$_SESSION['profile_user'];
		//echo "before insert";
		$postquery= "insert into user_posts values('','$post','$added_by','$user_posted_to', '$date_added')";
		//$queryselect="SELECT * FROM users WHERE email='$email'";

		$result=mysqli_query($con,$postquery);
	} else {
		echo "You must enter something in the post field before you can send it...";	
	}
?>
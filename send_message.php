<?php
	include('include/db.php');
	include('include/dbEC.php');
	session_start();

	if(!$configSite->Checklogin()){
		$configSite->redirectToURL("./access_denied.php");
	}
	
	($configSite->userName() == NULL) ? $login_user = " " : $login_user = $configSite->userName();
?>

<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="UTF-8">
		<title>Alumni Website</title>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/profile.css">
		<script src="js/main.js"></script>  
	</head>
	
	<body>
		<div id="navigation_container">
			<?php include './menu.php'?>
		</div>

		<?php
			$post = (isset($_POST['send_message']) ? $_POST['send_message'] : null);
			$msg_body = (isset($_POST['msg_body']) ? $_POST['msg_body'] : null);

			echo $login_user . " ". $post . " post..";

			if($post=="Send"){
				$date_added = date("y-m-d");
				$added_by = $login_user;
				echo $added_by;

				$user_posted_to = $_SESSION['profile_user'];

				echo $user_posted_to;
				//echo "before insert";

				echo $added_by."<br/>".$user_posted_to."<br/>".$msg_body;
				$postquery= "insert into messages(msg_body,msg_by,msg_to,date_added)". 
				"values('$msg_body','$added_by','$user_posted_to', '$date_added')";

				$result = mysqli_query($con,$postquery);
				if($result){
					//echo "record inserted succesfully";
					$msg_status = "true";
					header("Location: loginprofile.php?msg_status=".$msg_status);
				} else {
					echo "Problem with updation. Please try again";
					$msg_status = "false";
					header("Location: loginprofile.php?msg_status=".$msg_status);
				}
			} else {
				//echo "You must enter something in the message field before you can send it...";	
			}
		?>
		<div id="pageMiddle">
			<form method='post' action='send_message.php'>
				Type here to leave a message to your friend <b><?php echo $login_user;?></b><br>
				<textarea cols='40' rows='10' name='msg_body' value='msg_body'></textarea><br>
			<input type='submit' name='send_message' value='Send'>
		</form>
		</div>
	</body>
</html>
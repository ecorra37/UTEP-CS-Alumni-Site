 <?php
 include('include/db.php');
session_start();

if (!(isset($_SESSION['login_status']))) {

header ("Location: access_denied.php");
}

$login_user= $_SESSION['login_user'];
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Alumni Website</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/main.css">
		<script src="js/main.js" ></script>
		
		<script src="/ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
		<script src="/js/plugins.js"></script>
		<script src="/js/main.js"></script>
	</head>
	
    <body>
		<div id="navigation_container">
			<div class="rectangle">
				<ul id="navigation">
					<li><a href="index.php"><span id="highlight">Home</span></a></li>
					<li><a href="Store.php">Store</a></li>
					<li><a href="Find.php">Find Graduate</a></li>
					<li><a href="About.php">About Us</a></li>
						<?php if ((isset($_SESSION['login_status']))) {?>
					<li> <a href="loginprofile.php">Profile</a></li>
					<li> <a href="signout.php">Sign Out</a></li>
				</ul>
			</div>
						<?php }?>
		</div>
		
		<?php
			$user_from='';
			$query= "select * from friend_requests WHERE user_id_to='$login_user' and request_status='0'";

			$getquery=mysqli_query($con,$query);
			$count = mysqli_num_rows($getquery);

			if($count==0)
			{
				echo "You have no friend requests at this time";
			} else {
				while ($row= mysqli_fetch_assoc($getquery))
				{
				$freq_id = $row['frequest_id'];
				$user_to = $row['user_to'];
				$user_from = $row['user_from'];
		?>
		<div id=frnd_list>
			<p><b><?php echo $freq_id ." ".$user_from; ?></b>  wants to be your friend</p> 
			<form action="friend_requests.php" method="post">
				<input type="submit" name="accept<?php echo $user_from;?>"  value="Accept Request">   
				<input type="submit" name="reject<?php echo $user_from;?>"  value="Reject Request"> 
			</form>
		</div>
			<?php}
			}
			
		// TODO need to chekc for all users wrking only for last request	

		if(isset($_POST['accept'.$user_from]))
		{
			$date_added = date("y-m-d");
			
			$queryselect= "UPDATE friend_requests SET request_status='1',resuest_confirm_date='$date_added' WHERE user_to='$login_user'";

			$result=mysqli_query($con,$queryselect);

			if($result)
			{
				echo "$user_from is your friend now";
			} else {
				echo "Problem with updation. Please try again";
				// $act_update = "false";
				// header("Location: EditAccount.php?act_update=".$act_update);
			}
		}

		if(isset($_POST['reject'.$user_from]))
		{
			//echo $user_from." Friend Request Rejected";

			$date_added = date("y-m-d");

			$queryselect= "UPDATE friend_requests SET request_status='-1',resuest_confirm_date='$date_added' WHERE user_to='$login_user'";

			$result=mysqli_query($con,$queryselect);

			if($result)
			{
				echo "record updated succesfully";
				//$act_update = "true";
				//header("Location: EditAccount.php?act_update=".$act_update);
			} else {
				//do nothing
			}
		}
		?>
	</body>
</html>
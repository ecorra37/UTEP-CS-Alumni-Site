<?php
	include('include/db.php');
	session_start();

	if (!(isset($_SESSION['login_status']))) {
		header ("Location: access_denied.php");
	}

	isset($_SESSION['login_user']) ? $login_user = $_SESSION['login_user'] :  $login_user = "";
?>

<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="UTF-8">
		<title>Alumni Website</title>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/profile.css">
		<script src="js/main.js"></script>
		<script></script>
	</head>
	
	<body>
		<div id="navigation_container">
			<?PHP include './menu.php' ?>
		</div>
		
		<div id="view_list">
			<a href="friend_requests.php" >View Friend Requests</a>
			&nbsp;&nbsp;
			<a href="editprofile.php" >Edit Profile</a>
		</div>

		<?php
			// to show login user profile
			$username = $login_user;
			$_SESSION['profile_user']=$username;

			if(ctype_alnum($username))
			{
				//check user exist

				$query = "SELECT username,first FROM users WHERE username='$username'";

				$result = mysqli_query($con,$query);
				$count = mysqli_num_rows($result);

				if($count==1)
				{
					$get = mysqli_fetch_assoc($result);
					$username = $get['username'];
					$firstname = $get['first'];
					//echo "user exist";
				} else {
					echo "<meta http-equiv=\"refresh\" content=\"0; url=http://localhost/alumni/index.php\">";
					exit();
				}
			}

			// function to sanitize the user input
			function sanitizeString($var)
			{
				$var = stripcslashes($var);
				$var = strip_tags($var);
				$var = htmlentities($var);
				return $var;
			}
		?>
		<div class="postForm">
			<textarea id="post" name="post" rows="3" cols="58"></textarea>
			<input type="submit" name="send" onclick="send_post()" value="Post" style="background-color: #DCESEE; float:right; border: 1px solid:#6666">
			<p id="status">un</p>
		</div>

		<div class="profilePosts"> 
		<?php
			// to display post based on user profile
			//echo $username;
			$getquery= "select * from user_posts WHERE added_to='$username'";

			$getposts=mysqli_query($con,$getquery);

			while ($row= mysqli_fetch_assoc($getposts))
			{
				$post_id = $row['post_id'];
				$body = $row['post_body'];
				$date_added=$row['date_added'];
				$added_by=$row['added_by'];
				$user_posted_to =$row['added_to'];

				echo " <div class='posted_by'> $added_by  $date_added </div>&nbsp;&nbsp;$body<br/><hr/>";
			}
		?>
		</div>
		<img src="./img/ice1.jpg" height="200" width="200" alt="<?php echo $username;?>'s profile" title="<?php echo $username;?>'s profile"/>
		<br/>
		
		<div class="textHeader"><?php echo $username;?>'s Profile</div>
		<div class="profileleftSideContent">
			<?php
				// to display profile user bio data
				//echo $username;
				$getquery= "select * from users WHERE username='$username'";

				$getbio=mysqli_query($con,$getquery);

				while ($row= mysqli_fetch_assoc($getbio))
				{
					$bio = $row['bio_data'];

					echo " $bio<br/>";
				}
			?>
		</div>
		<div class="textHeader"><?php echo $username;?>'s Friends</div>
		<div class="profileleftSideContent">
			<img src="#" height="50" width="20"/>&nbsp;&nbsp;
			<img src="#" height="50" width="20"/>&nbsp;&nbsp;
			<img src="#" height="50" width="20"/>&nbsp;&nbsp;
			<img src="#" height="50" width="20"/>&nbsp;&nbsp;
			<img src="#" height="50" width="20"/>&nbsp;&nbsp;
			<img src="#" height="50" width="20"/>&nbsp;&nbsp;
			<img src="#" height="50" width="20"/>&nbsp;&nbsp;
			<img src="#" height="50" width="20"/>&nbsp;&nbsp;
		</div>
	</body>
</html>
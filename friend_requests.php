<?php
	include('include/db.php');
	include('include/dbEC.php');

	if(!$configSite->Checklogin()){
		$configSite->redirectToURL("./access_denied.php");
	}

	($configSite->userName() == NULL) ? $login_user = " no username" : $login_user = $configSite->userName();
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
	</head>

	<body>
		<div id="navigation_container">    
			<?php include 'menu.php';?>
		</div>

		<script src="/ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
		<script src="/js/plugins.js"></script>
		<script src="/js/main.js"></script>
		
		<div id="pageMiddle">
			<?php
				$user_from = '';
				$query = "select * from friend_requests WHERE user_id_to='$login_user' and request_status='0'";
				$getquery = mysqli_query($con,$query);
				$count = mysqli_num_rows($getquery);
				
				if($count == 0){
					echo "You have no friend requests at this time";
				} else {
					while ($row= mysqli_fetch_assoc($getquery)){
						$user_from = $row['user_id_from'];
			?>
						<div id=frnd_list><p> <b><?php echo $user_from; ?></b>  wants to be your friend</p> 
							<form action="f_request.php" method="post"> 
								<input type="submit" name="accept"  value="Accept <?php echo $user_from;?>">   
								<input type="submit" name="reject"  value="Reject <?php echo $user_from;?>">
							</form>
						</div>
				<?php }
			} ?>
		</div>
	</body>
</html>
<?php
	include('include/dbEC.php');
	include('include/db.php');
	/*session_start();

	isset($_SESSION['login_user']) ? $username = $_SESSION['login_user'] : header ("Location: access_denied.php");*/
	
	if(!$configSite->Checklogin()){
		$configSite->redirectToURL("./access_denied.php");
	}
	
	($configSite->userName() == NULL) ? $login_user = " no username" : $login_user = $configSite->userName();
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

		<?php
			echo "<h3>View your messages below</h3><br/>";

			$query = "select * from messages WHERE msg_to='$login_user' and msg_status='0'";

			$getquery = mysqli_query($con, $query);
			$count = mysqli_num_rows($getquery) or die("no count");

			if($count == 0){
				echo "You have no messages";
			} else {
				echo "You have ". $count.  " messages";
				echo '<div class="view_messages">'; 
					echo '<table border="2">';
						echo '<th>M.No</th>';
						echo '<th>Message From</th>';
						echo '<th>Message Date</th>';
						echo '<th>Message Status</th>';
						echo '<th>View</th>';
						
						$i = 1;		
						while($row = mysqli_fetch_assoc($getquery)){
							$msg_by        = $row['msg_by'];
							$msg_body      = $row['msg_body'];
							$msg_post_date = $row['date_added'];
							$msg_status    = "Unread";

							echo '<tr>';
								echo '<td>'. $i . '</td>';
								echo '<td>'. $msg_by . '</td>';
								echo '<td>'. $msg_post_date. '</td>';
								echo '<td>'. $msg_status. '</td>';
								echo '<td>' .$msg_body. ' </td>';
							echo '</tr>';

							$i = $i+1;
						}
					echo '</table>';
				echo '</div>';
			}
		?>
	</body>
</html>
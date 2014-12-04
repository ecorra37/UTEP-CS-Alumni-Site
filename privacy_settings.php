<?php
	include('include/db.php');
	include('include/dbEC.php');
	session_start();

	if(!$configSite->Checklogin()){
		$configSite->redirectToURL("./access_denied.php");
	}

	($configSite->userName() == NULL) ? $login_user = " no username" : $login_user = $configSite->userName();
?>

<!DOCTYPE html>
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
		<?php include './menu.php'?>
		</div>

		<div id="pageMiddle">
			<?php 
				echo "<h4>Account Privacy Settings</h4></br>";

				$query="select * from privacy where user_name='$login_user' and privacy_field_status='1'";

				$getquery=mysqli_query($con,$query);

				echo '<div class="view_messages">'; 
				echo '<table border="2">';
				echo '<th>Property Name</th>';
				echo '<th>Property Value</th>';
				echo '<th>Hide/Unhide</th>';

				while ($row= mysqli_fetch_assoc($getquery)){
					$property_name = $row['property_name'];
					$property_value = $row['property_value'];
					$hide_status = $row['hide_status'];

					echo '<tr>';
					echo '<td><b>' . $property_name. '</b></td>';
					echo '<td>'. $property_value . '</td>';
					echo '<form action="privacy_set.php" method="post">'; 
					if($hide_status=="on"){
						echo "<td><input type='checkbox' id='hide_status' name='hide_status' checked/></td>";
					} else {
						echo "<td><input type='checkbox' id='hide_status' name='hide_status'></td>";
					}
					echo '<td>';
					echo "<input type='submit' name='profile_settings'  value='Update $property_name''>"; 
					echo '</form>';
					echo '</td>';
					echo '</div>';	
					echo '</tr>';
				}
				echo '</table>';
			?>
		</div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
		<script src="js/plugins.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>
<?php
	include('include/db.php');
	session_start();
	$login_user = $_SESSION['login_user'];
?>

<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="UTF-8">
		<title>Alumni Website</title>
		<link rel="stylesheet" href="css/main.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/main.js" ></script>   
		<!-- <script type="text/javascript" src="jquery.min.js"></script> -->
	</head>
	<body>
		<div id="navigation_container">
			<?PHP include './menu.php' ?>
		</div>
	</body>
</html>
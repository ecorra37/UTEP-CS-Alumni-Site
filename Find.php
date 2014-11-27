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
		<script src="js/main.js" ></script>
	</head>
	
	<body>
		<div id="navigation_container">
			<?PHP include './menu.php' ?>
		</div>
		<div class="main_content">
			<div>
				<?PHP include './login.php'; ?>
			</div>
			<div>
				<?PHP include './search.php'; ?>
			</div>
		</div>
		<div>
			<?PHP include './footer.php'; ?>
		</div>
	</body>
</html>
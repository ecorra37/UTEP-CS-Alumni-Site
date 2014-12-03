<?php
	/*include('include/dbEC.php');
	session_start();
	isset($_SESSION['login_user']) ? $login_user = $_SESSION['login_user'] :  $configSite->RedirectToURL('./index.php');*/
?>

<html>
	<head lang="en">
		<meta charset="UTF-8">
		<title>Alumni Website</title>
		<link rel="stylesheet" href="css/main.css">
	</head>
	
	<body>
		<div id="navigation_container">
			<?PHP include './menu.php' ?>
		</div>
		<div class="main_content">
			<div>
				<?PHP include './search.php'; ?>
			</div>
			<div>
				<?PHP include './footer.php'; ?>
			</div>
		</div>
		
	</body>
</html>
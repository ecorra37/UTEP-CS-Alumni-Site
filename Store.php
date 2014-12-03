
<?php
	include('include/dbEC.php');
	//should not be checking for session, anyone can buy items.
	/*if(isset($_POST['submitted'])){
		if($configSite->login()){
			$configSite->redirectToURL("./index.php");
		}
	}*/
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
			<div>
				<?PHP include './menu.php' ?>
			</div>
			<div>
				<?PHP include './footer.php'; ?>
			</div>
		</div>
		
	</body>
</html>
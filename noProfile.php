<?php
	include('include/dbEC.php');

	if(!$configSite->Checklogin()){
		$configSite->redirectToURL("./access_denied.php");
	}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body>
		<div id="navigation_container">
			<?php include './menu.php';?>
		</div>
		<div id="pageMiddle">
			<div>
				<?php echo "Sorry! User Does Not Have a Profile. Search Again."; ?>
			</div>
			<br/><br/>
			<div>
				<?PHP include './search.php'; ?>
			</div>
		</div>
		
	</body>
</html>
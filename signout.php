<?php
	session_start();

	$_SESSION['login_status']=false;
	unset($_SESSION["login_status"]);

	// redirect to login
	header("Location:index.php");
?>
<?php
	$currency = '$';
	$hostname = "earth.cs.utep.edu";
	$database = "cs5339team9fa14";
	$username = "cs5339team9fa14";
	$password = "cs5339!cs5339team9fa14";
	$con = mysqli_connect($hostname, $username, $password, $database);
	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}
	//else
	//    echo "connected";
?>
<?php
	$host     = "earth.cs.utep.edu";
	$username = "cs5339team9fa14";
	$password = "cs5339!cs5339team9fa14";
	$db       = "cs5339team9fa14";
	
	//need to include $db = 'f14'; in the working file before the include('mysql_con.php');
	$con = mysqli_connect($host, $username, $password, $db) or die('Problem with Connection!');
?>
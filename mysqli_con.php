<?php

	$host 		= "localhost";
	$username 	= "root";
	$password 	= "viao";
	
	//need to include $db = 'f14'; in the working file before the include('mysql_con.php');
	$con = mysqli_connect($host,$username,$password, $db) or die('Problem with Connection!');
	
?>

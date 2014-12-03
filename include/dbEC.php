<?php
$currency='$';
$hostname="localhost";
$database="cs5339teamxfa14";
$username="root";
$password="";
 $con=mysqli_connect($hostname,$username,$password,$database);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
//else
//    echo "connected";

?>
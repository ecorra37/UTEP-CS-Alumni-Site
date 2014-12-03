<?php
 include('include/db.php');
session_start();

if (!(isset($_SESSION['login_status']))) {

header ("Location: access_denied.php");
}

$login_user= $_SESSION['login_user'];
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Alumni Website</title>
    <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/profile.css">

	<script src="js/main.js"></script>
    <script>
	
</script>
    
</head>
<body>

<div id="navigation_container">
         <div class="rectangle">
        <ul id="navigation">

            <li><a href="index.php"><span id="highlight">Home</span></a></li>
            <li><a href="Store.php">Store</a></li>
            <li><a href="Find.php">Find Graduate</a></li>
            <li><a href="About.php">About Us</a></li>
                       <?php if ((isset($_SESSION['login_status']))) {
?>

            <li> <a href="loginprofile.php"">Profile</a></li>
              <li> <a href="signout.php">Sign Out</a></li>
        </ul>
    </div>
<?php }?>
</div>

<?php

echo "<h3>View your messages below</h3><br/>";


   $query= "select * from messages WHERE msg_to='$login_user' and msg_status='0'";

$getquery=mysqli_query($con,$query);
$count = mysqli_num_rows($getquery);

if($count==0)
{
	echo "You have no messages";
	
}
else
{
	echo "You have ". $count.  " messages";
	echo '<div class="view_messages">'; 
            echo '<table border="2">';
            echo '<th>';
			 echo "M.No";
			echo '</th>';
			 echo '<th>';
			   echo "Message From";
			 echo '</th>';
			
			  echo '<th>';
			  echo "Message Date";
			 
			 echo '</th>';
			   echo '<th>';
			  echo "Message Status";
			 echo '</th>';
			   echo '<th>';
			  echo "View";
			 echo '</th>';
		$i=1;		
 while($row= mysqli_fetch_assoc($getquery))
{

	$msg_by= $row['msg_by'];
	$msg_body=$row['msg_body'];
	$msg_post_date=$row['date_added'];
	$msg_status="Unread";

	
		echo '<tr>';
		echo '<td>'. $i . '</td>';
		echo '<td>'. $msg_by . '</td>';
			echo '<td>'. $msg_post_date. '</td>';
			echo '<td>'. $msg_status. '</td>';
			echo '<td>' .$msg_body. ' </td>';
		echo '</tr>';
		
			
          $i=$i+1;
	
}
  echo '</table>';
            echo '</div>';
}
	





?>








</body>
</html>

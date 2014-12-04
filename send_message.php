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

$post = (isset($_POST['send_message']) ? $_POST['send_message'] : null);
$msg_body = (isset($_POST['msg_body']) ? $_POST['msg_body'] : null);

if($post!="")
{

$date_added = date("y-m-d");
$added_by =$login_user;
$user_posted_to =$_SESSION['profile_user'];
	//echo "before insert";
	
	echo $added_by."<br/>".$user_posted_to."<br/>".$msg_body;
	$postquery= "insert into messages(msg_body,msg_by,msg_to,date_added) values('$msg_body','$added_by','$user_posted_to', '$date_added')";
    
     
    $result=mysqli_query($con,$postquery);
 if($result)
    {
        //echo "record inserted succesfully";
        $msg_status = "true";
        header("Location: loginprofile.php?msg_status=".$msg_status);
    }
 else 
        
 {
     echo "Problem with updation. Please try again";
     $msg_status = "false";
        header("Location: loginprofile.php?msg_status=".$msg_status);
 }
	
}
else
{

	
//echo "You must enter something in the message field before you can send it...";	
}



?>

 <form method='post' action='send_message.php'>
      Type here to leave a message to your friend <b><?php echo $_SESSION['profile_user'];?></b><br>
      <textarea cols='40' rows='10' name='msg_body' value='msg_body'></textarea><br>
     
      <input type='submit' name='send_message' value='Send'>
</form>

</body>
</html>

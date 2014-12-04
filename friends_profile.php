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
if(!isset($_GET['u']))
{
	// to show login user profile
	$username=$login_user;
    $_SESSION['profile_user']=$username; 

}
else
{   // to show friend profile
	$username=sanitizeString($_GET['u']);
	$_SESSION['profile_user']=$username; 
}
if(ctype_alnum($username))
{

//check user exist

$query = "SELECT username,first FROM users WHERE username='$username'";

$result = mysqli_query($con,$query);
$count=  mysqli_num_rows($result);
      
if($count==1)
{

$get = mysqli_fetch_assoc($result);
$username=$get['username'];
$firstname=$get['first'];
//echo "user exist";
}
else
{
echo "<meta http-equiv=\"refresh\" content=\"0; url=http://localhost/alumni/index.html\">";
exit();
}
}


// function to sanitize the user input
function sanitizeString($var)
{
    $var=  stripcslashes($var);
    $var=  strip_tags($var);
    $var=  htmlentities($var);
    return $var;
}
?>


<div class="postForm">

<textarea id="post" name="post" rows="3" cols="58"></textarea>
<input type="submit" name="send" onclick="send_post()" value="Post" style="background-color: #DCESEE; float:right; border: 1px solid:#6666">
<p id="status">Post Here</p>
</div>

<div class="profilePosts"> 

<?php

// to display post based on user profile
//echo $username;
$getquery= "select * from user_posts WHERE added_to='$username'";

$getposts=mysqli_query($con,$getquery);

while ($row= mysqli_fetch_assoc($getposts))
{
$post_id = $row['post_id'];
$body = $row['post_body'];
$date_added=$row['date_added'];
$added_by=$row['added_by'];
$user_posted_to =$row['added_to'];

echo " <div class='posted_by'> $added_by  $date_added </div>&nbsp;&nbsp;$body<br/><hr/>";
}

?>


</div>
<img src="./img/ice1.jpg" height="200" width="200" alt="<?php echo $username;?>'s profile" title="<?php echo $username;?>'s profile"/>
<br/>
<?php if($login_user==$_SESSION['profile_user'])
{
	//do nothing
}
else
{ // show add frind and send message buttons
//echo "$msg";	

	
$getquery= "select * from friend_requests WHERE user_id_from='$username' and user_id_to='$login_user'";

$newuser=mysqli_query($con,$getquery);

$count=  mysqli_num_rows($newuser);
      
if($count==0)
{
	/*echo "<form action ='send_request.php' method='POST'>";
	echo "<input type='hidden' name='add_request' value=''>";
	echo "<input type='submit' name='addFriend' value='Add Friend'/>";
	echo "</form>";
	*/
	echo "<br/>";
	echo "<form action='send_message.php'>";
	echo "<input type='submit' name='sendmsg' value='Send Message'/>";
echo "</form>";
}
else
{
echo "<br/>";
echo "<form action ='send_message.php' method='POST'>";
echo "<input type='submit' name='sendmsg' value='Send Message'/>";
echo "</form>";
echo "<br/>";

}
}
?>

<div class="textHeader"><?php echo $username;?>'s Profile</div>
<div class="profileleftSideContent">
<?php
// to display profile user bio data
//echo $username;
$getquery= "select * from users WHERE username='$username'";

$getbio=mysqli_query($con,$getquery);

while ($row= mysqli_fetch_assoc($getbio))
{
$bio = $row['bio_data'];
$email=$row['email'];
$fname=$row['first'];
$lname=$row['last'];
$gender=$row['gender'];
$city=$row['city'];
$address=$row['address'];

echo "<b>Bio Data : </b>". $bio. "<br/>";
echo "<b>First Name : </b>". $fname. "<br/>";
echo "<b>Last Name : </b>". $lname. "<br/>";
echo "<b>Email : </b>". $email. "<br/>";
echo "<b>Gender : </b>". $gender. "<br/>";
echo "<b>City : </b>". $city. "<br/>";
echo "<b>Address : </b>". $address. "<br/>";
}
?>

</div>

<div class="textHeader"><?php echo $username;?>'s Friends</div>
<div class="profileleftSideContent">

<?php


   $query= "select * from friend_requests WHERE (user_id_to='$username' and request_status='1') or (user_id_from='$username' and request_status='1') ";


$getquery=mysqli_query($con,$query);
$count = mysqli_num_rows($getquery);

if($count==0)
{
	echo "No friends to display";
	
}
else
{
	
	
while ($row= mysqli_fetch_assoc($getquery))
{
	
	$loginuser_from= $row['user_id_from'];
	$loginuser_to= $row['user_id_to'];
	
	
	if($loginuser_from!=$username)
	{
		$fn=$loginuser_from;
	echo "<a href='friends_profile.php?u=$fn'>$loginuser_from</a> <br/>";
	}
		if($loginuser_to!=$username)
	{
		$fn=$loginuser_to;
	echo "<a href='friends_profile.php?u=$fn'>$loginuser_to</a> <br/>";
	}
	
	
}
}
	
?>


</div>



</body>
</html>
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
 <div id="welcome">
            <p>

            Welcome <?php echo "<b>" .$login_user. "</b>"; ?>

</p></div>

 <?php  
              if (isset($_GET['act_update']))
              {
              $Message = $_GET['act_update'];
              if($Message=="true")
              {
                  echo "<p style='color:green; font-size: 11pt;font-weight: bold;'> Account Updated Succesfully </P></br>";
              }
              else
              {
                echo "<p style='color:red; font-size: 11pt;font-weight: bold;'> Problem with updation. Please try again </P></br>";  
              }
              }
              ?>
<?php  
              if (isset($_GET['msg_status']))
              {
              $Message = $_GET['msg_status'];
              if($Message=="true")
              {
                  echo "<p style='color:green; font-size: 11pt;font-weight: bold;'>Your message sent to <b>" . $_SESSION['profile_user']. "</b> succesfully </P></br>";
              }
              else
              {
                echo "<p style='color:red; font-size: 11pt;font-weight: bold;'> Problem with message sending. Please try again </P></br>";  
              }
              }
              ?>
<?php  
              if (isset($_GET['privacy_update']))
              {
              $Message = $_GET['privacy_update'];
              if($Message=="true")
              {
                  echo "<p style='color:green; font-size: 11pt;font-weight: bold;'>You privacy data updated succesfully </P></br>";
              }
              else
              {
                echo "<p style='color:red; font-size: 11pt;font-weight: bold;'> Problem with hiding field. Please try again </P></br>";  
              }
              }
              ?>
               <?php  
              if (isset($_GET['frnd_status']))
              {
              $Message = $_GET['frnd_status'];
              if($Message=="true")
              {
                  echo "<p style='color:green; font-size: 11pt;font-weight: bold;'> You accepted your friend request </P></br>";
              }
              else 
              {
                echo "<p style='color:red; font-size: 11pt;font-weight: bold;'> You rejected your friend request</P></br>";  
              }
              }
              ?>
<div id="view_list">
<a href="friend_requests.php" >View Friend Requests</a>
&nbsp;&nbsp;
<a href="editprofile.php" >Edit Profile</a>
&nbsp;&nbsp;
<a href="view_messages.php" >View Messages</a>
</div>
<?php
	// to show login user profile
	$username=$login_user;
    $_SESSION['profile_user']=$username; 

if(ctype_alnum($username))
{

//check user exist

$query = "SELECT * FROM users WHERE username='$username'";

$result = mysqli_query($con,$query);
$count=  mysqli_num_rows($result);
      
if($count==1)
{

$get = mysqli_fetch_assoc($result);
$username=$get['username'];
$fname=$get['first'];
$lname=$get['last'];
$bio = $get['bio_data'];
$profile_pic_db = $get['profile_pic'];
//echo "user exist";
}

else
{
echo "<meta http-equiv=\"refresh\" content=\"0; url=http://localhost/alumni/index.php\">";
exit();
}
//Check whether the user has uploaded a profile pic or not

  if ($profile_pic_db == "") {
  $profile_pic = "img/default_pic.jpg";
  }
  else
  {
  $profile_pic = $profile_pic_db;
  }
$_SESSION['profile_pic']=$profile_pic;
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
<img src="<?php echo $profile_pic; ?>" height="200" width="200" alt="<?php echo $username; ?>'s Profile" title="<?php echo $username; ?>'s Profile" />
<br/>


<div class="textHeader"><?php echo $username;?>'s Profile</div>
<div class="profileleftSideContent">
<?php
// to display profile user data


echo "<b>Bio Data : </b>". $bio. "<br/>";
echo "<b>First Name : </b>". $fname. "<br/>";
echo "<b>Last Name : </b>". $lname. "<br/>";


$getquery= "select * from privacy WHERE user_name='$username' and privacy_field_status='1'";
$getbio=mysqli_query($con,$getquery);

while ($row= mysqli_fetch_assoc($getbio))
{
	
$property_name=$row['property_name'];
$property_value=$row['property_value'];
$hide_status=$row['hide_status'];

if($hide_status=="off")
{
echo "<b>$property_name : </b>". $property_value. "<br/>";
}

}

?>

<a href="privacy_settings.php" >Privacy Settings</a>
</div>
<div class="textHeader"><?php echo $username;?>'s Friends</div>
<div class="profileleftSideContent">

<?php

   $query= "select * from friend_requests WHERE (user_id_to='$login_user' and request_status='1') or (user_id_from='$login_user' and request_status='1') ";

$getquery=mysqli_query($con,$query);
$count = mysqli_num_rows($getquery);

if($count==0)
{
	echo "You have no friends";
	
}
else
{
	
	
while ($row= mysqli_fetch_assoc($getquery))
{
	
	$loginuser_from= $row['user_id_from'];
	$loginuser_to= $row['user_id_to'];
	
	
	if($loginuser_from!=$login_user)
	{
		$fn=$loginuser_from;
	echo "<a href='friends_profile.php?u=$fn'>$loginuser_from</a> <br/>";
	}
		if($loginuser_to!=$login_user)
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
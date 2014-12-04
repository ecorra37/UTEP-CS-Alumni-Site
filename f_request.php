 <?php
 include('include/db.php');
session_start();
$login_user= $_SESSION['login_user'];

?>
  <?php	
 // TODO need to chekc for all users wrking only for last request	
// list($stat, $user_from) = split("/ ", $_POST['accept']);
$user_from=$_POST['accept'];
 list($stat, $user_from) = explode(" ", $user_from);
 
 
// $user_from=$_POST['reject'];

$frnd_status="false";
 if(isset($_POST['accept']))
{

$date_added = date("y-m-d");


   $queryselect= "UPDATE friend_requests SET request_status='1',request_confirm_date='$date_added' WHERE user_id_to='$login_user' and user_id_from='$user_from'";
    

    $result=mysqli_query($con,$queryselect);
    	
    if($result)
    {
     // echo "$user_from is your friend now";
	  $frnd_status = "true";
        header("Location: loginprofile.php?frnd_status=".$frnd_status);
    }
 else 
        
 {
     echo "Problem with updation. Please try again";
   
 }



}

$user_from=$_POST['reject'];
 list($stat, $user_from) = explode(" ", $user_from);
if(isset($_POST['reject']))
{
//echo $user_from." Friend Request Rejected";

$date_added = date("y-m-d");

  $queryselect= "UPDATE friend_requests SET request_status='-1',request_confirm_date='$date_added' WHERE user_id_to='$login_user' and user_id_from='$user_from'";
    
    $result=mysqli_query($con,$queryselect);
    
    if($result)
    {
    // echo "Friend request rejected";
	  $frnd_status = "false";
        header("Location: loginprofile.php?frnd_status=".$frnd_status);
    }
 else 
        
 {
     //do nothing
	     echo "Problem with updation. Please try again";
 }


}
  


?> 
 <?php
 include('include/db.php');
session_start();

if (!(isset($_SESSION['login_status']))) {

header ("Location: access_denied.php");
}

$login_user= $_SESSION['login_user'];
?>
<!DOCTYPE html>
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Alumni Website</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/main.js" ></script>



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

            <li> <a href="loginprofile.php">Profile</a></li>
              <li> <a href="signout.php">Sign Out</a></li>
        </ul>
    </div>
<?php }
else {
?>
</div>



<div>
			<span id="login_input">
	<form name="Login_Form" action="validate.php" onsubmit="return validateForm()" method="post">
		User Name:<input type="text" name="username"><br>
		Password:<input type="password" name="password"><br>
		<input type="submit" value="Login" name="login_submit">
		<p id="Message"></p>
	</form>
</span>
			</div>
            
       <?php } ?>     




  <div id="pageMiddle">

   <?php 

echo "<h4>Account Privacy Settings</h4></br>";

     $query="select * from privacy where user_name='$login_user' and privacy_field_status='1'";
    
$getquery=mysqli_query($con,$query);
	    
   
	
    echo '<form action="test.php" method="post">'; 
	echo '<div class="view_messages">'; 
            echo '<table border="2">';
          
			
			 echo '<th>';
			   echo "Property Name";
			 echo '</th>';
			
			 echo '<th>';
			   echo "Property Value";
			 echo '</th>';
				
			  echo '<th>';
			  echo "Hide/Unhide";
			 echo '</th>';
			 
				  
	
while ($row= mysqli_fetch_assoc($getquery))
{

	
$property_name=$row['property_name'];
$property_value=$row['property_value'];
$hide_status=$row['hide_status'];

		echo '<tr>';
		echo '<td><b>' . $property_name. '</b></td>';
		echo '<td>'. $property_value . '</td>';

		if($hide_status=="on")
		{
		echo "<td><input type='checkbox' id='hide_status' name='hide_status' value='1' checked/></td>";
		
		}
		else
		{
		echo "<td><input type='checkbox' id='hide_status' name='hide_status' value='0'></td>";
		} 
		
	/*
		
		 if (strcasecmp($hide_status, "on") == 0)
                        {
        echo "<td><input type='radio' name='hide_status' value='Hide' checked> Hide <input type='radio' name='hide_status' value='Unhide' > Unhide  
					</td>";
					
                        }
                        else
                        {
         echo "<td><input type='radio' name='hide_status' value='Hide'> Hide <input type='radio' name='hide_status' value='Unhide' checked> Unhide  
					</td>";
					
					}
					
					*/
		
		echo '<td>';
echo '<input type="hidden" name="property_name"  value='.$property_name.'>'; 
echo "<input type='submit' name='profile_settings'  value='Update $property_name''>"; 
 

echo '</form>';
	echo '</td>';
  echo '</div>';	
		
		echo '</tr>';
	  

}

echo '</table>';

?>
	 
  </div>





        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>

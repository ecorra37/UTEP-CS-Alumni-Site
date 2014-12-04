 <?php
 include('include/db.php');
session_start();

$login_user= $_SESSION['login_user'];
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Alumni Website</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/main.js" ></script>   
   <!-- <script type="text/javascript" src="jquery.min.js"></script> -->
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
<?php }?>
</div>
  <div id="pageMiddle">
    <p >

The UTEP CS Alumni Association exists to help you stay connected to UTEP, wherever you are in your life now you can connect with University!!! </p>

            <p >The UTEP CS Alumni Association helps to create the vibrant connection between alumni, students, faculty, parents and friends as well as link the community to our great College. All UTEP CS graduates can enter into the alumni association and remain part of our community for life. </p> 

            <p >The UTEP CS almuni Association is always ready and willing to offer help and advice and provide answers. Always glad to hear your ideas and suggestions for how we can serve you better! </p>

            <p style ="padding: 24px; width:500px; line-height:1.5em;">
            <h3> Contact Information</h3> </br>

                Phone:   +1 915 - 000-000 </br>

                Fax:       "     "     "    000</br>

                Email: csalmuni@utep.edu </br></br>
            <u>Mailing Address (for US mail)</u></br>
Department of Computer Science                 
Mailing Address (for US mail)</br>
Chemistry & Computer Science Building </br>
Room 3.1024 </br>
500 West University Avenue </br>
El Paso, TX 79968-0518 </br>

</p>
            
            
            
        </div>
</body>
</html>
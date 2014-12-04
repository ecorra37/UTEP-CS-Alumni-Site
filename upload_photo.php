 <?php
 include('include/db.php');
include('include/dbEC.php');

	if(!$configSite->Checklogin()){
		$configSite->redirectToURL("./access_denied.php");
	}

	($configSite->userName() == NULL) ? $login_user = " " : $login_user = $configSite->userName();

$target_dir = "img/user_photos/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//echo $target_file ;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "PNG") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	$RandomAccountNumber = uniqid();
	$target_file =$target_file .$RandomAccountNumber;
     
	
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		
		
   $queryselect= "UPDATE users SET profile_pic='$target_file' WHERE username='$login_user'";


    $result=mysqli_query($con,$queryselect);
    
    if($result)
    {
		 $act_update = "true";
        header("Location: loginprofile.php?act_update=".$act_update);
	}
		
    } else {
       // echo "Sorry, there was an error uploading your file.";
	    $act_update = "false";
        header("Location: loginprofile.php?act_update=".$act_update);
    }
}
?>
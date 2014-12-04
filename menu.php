<?PHP
	include('include/dbEC.php');
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script language="javascript"> 
function toggle() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "Login";
  	} else {
		ele.style.display = "block";
		text.innerHTML = "Login";
	}
} 
</script>

<div class="rectangle">
	<ul id="navigation">
		<li><a href="./index.php"><span id="highlight">Home</span></a></li>
		<li><a href="./store.php">Store</a></li>
		<li><a href="./find.php">Find Graduate</a></li>
		<li><a href="./about.php">About Us</a></li>
		
			<?php if($configSite->CheckLogin()){?>
		<li><a href="./loginprofile.php">Profile</a></li>
		<li><a href="./signout.php">Sign Out</a></li>
	</ul>
</div>
			<?php } elseif(!$configSite->CheckLogin()){?>
				<li><a id="displayText" href="javascript:toggle();">Login</a></li>
				<div id="toggleText" style="display: none"><?php include './login.php';?></div>
			<?php }
<div class="rectangle">
	<ul id="navigation">
		<li><a href="index.php"><span id="highlight">Home</span></a></li>
		<li><a href="Store.php">Store</a></li>
		<li><a href="Find.php">Find Graduate</a></li>
		<li><a href="About.php">About Us</a></li>
			<?php if ((isset($_SESSION['login_status']))) {?>
		<li> <a href="loginprofile.php">Profile</a></li>
		<li> <a href="signout.php">Sign Out</a></li>
	</ul>
</div>
			<?php } ?>
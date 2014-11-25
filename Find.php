<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="UTF-8">
		<title>Alumni Website</title>
		<link rel="stylesheet" href="css/main.css">
		<script src="js/main.js" ></script>
	</head>
	
	<body>
		
		<div id="navigation_container">
			<div class="rectangle">
				<ul id="navigation">
					<li><a href="index.html">Home</a></li>
					<li><a href="Profile.html">Profile</a></li>
					<li><a href="Store.html">Store</a></li>
					<li><a href="Donate.html">Donate</a></li>
					<li><a href="Find.php"><span id="highlight">Find Graduate</span></a></li>
					<li><a href="AboutUs.html">About</a></li>
				</ul>
			</div>
		</div>
		
		<div class="main_content">
			<div>
				<?PHP include './login.php'; ?>
			</div>
			
			<div>
				<?PHP include './search.php'; ?>
			</div>
		</div>
	</body>
</html>
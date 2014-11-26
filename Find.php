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
					<li><a href="index.php"><span id="highlight">Home</span></a></li>
            <li><a href="Store.php">Store</a></li>
            <li><a href="Find.php">Find Graduate</a></li>
            <li><a href="About.php">About Us</a></li>
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
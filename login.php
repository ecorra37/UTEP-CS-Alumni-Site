<?PHP
	include('include/dbEC.php');
	if(isset($_POST['submitted'])){
		if($configSite->login()){
			$configSite->redirectToURL("./loginprofile.php");
		}
	}
?>

<html>
	<head>
		
	</head>
	<body>
		<span id="login_input">
			<form name="Login_Form" action="<?PHP $configSite->GetSelfScript(); ?>" method="POST">
				
				<input type="hidden" name="submitted" id="submitted" value="1"/>
				
				<div><span class="error"><?php echo $configSite->GetErrorMessage(); ?></span></div>
				
				<input type="text" name="Username" value="<?php echo $configSite->SafeDisplay('Username') ?>" maxlength="50"><br>
				
				<input type="password" name="password" maxlength="50"><br>
				
				<input type="submit" name="submit" value="Login">
			</form>
		</span>
	</body>
</html>
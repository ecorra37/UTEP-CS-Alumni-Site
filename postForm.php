<?php
	include('include/dbEC.php');
	
	if(!$configSite->Checklogin()){
		$configSite->redirectToURL("./access_denied.php");
	}
	
	/*to submit a post it is not refreshing and not saving into my DB.*/
	if(isset($_POST['submitted'])){
		$configSite->send_Post();
	}
	
	($configSite->userName() == NULL) ? $login_user = " no username" : $login_user = $configSite->userName();
?>

<form name="postForm" action="<?PHP $configSite->GetSelfScript(); ?>" method="POST">
	<input type="hidden" name="submitted" id="submitted" value="1"/>
	
	<div><span class="error"><?php echo $configSite->GetErrorMessage(); ?></span></div>
	
	<textarea id="post" name="post" value="<?php echo $configSite->SafeDisplay('post') ?>" rows="3" cols="58"></textarea>
	
	<input type="submit" name="post" value="post" style="background-color: #DCESEE; float:right; border: 1px solid:#6666">
	
	<p id="status">Post Here</p>
</form>
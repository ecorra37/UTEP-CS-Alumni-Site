<?PHP
	require_once("./include/db.php");
?>

<form name="Login_Form" action="Find.php" onsubmit="return validateForm()" method="post">
	<input type="text" name="search" value="hello"><br>
	<input type="submit" value="Login">
	<p id="Message"></p>
</form>
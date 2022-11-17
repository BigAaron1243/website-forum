<?php echo str_replace("_TITLE", "Create an Account", file_get_contents("html/header.html"));?>
<form action="loginpost.php" method="post">
	<label>Login:<br></label>
	<label>Name:<br></label>
	<input type="text" name="name"><br>
	<label>Password:<br></label>
	<input type="password" name="password"><br>
	<input style="margin-top:8px;" type="submit" value="submit">
</form>

<?php 
if (isset($_GET['code'])) {
	switch ($_GET['code']) {
		case 1:
			echo "name is required";
			break;
		case 2:
			echo "password is required";
			break;
		case 3:
			echo "the username or password is incorrect";
			break;
	}
}
?>

<?php echo file_get_contents("html/footer.html");?>


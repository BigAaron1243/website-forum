<?php 
session_start();
$title = "Sign in to lesite";
require 'header.php';
?>
<form action="loginpost.php" method="post">
	<label>Login:<br></label>
	<label>Name:<br></label>
	<input type="text" name="name"><br>
	<label>Password:<br></label>
	<input type="password" name="password"><br>
	<?php echo file_get_contents('cap.html'); ?>
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
		case 4:
			echo "the security question is incorrect";
			break;

	}
}
?>

<?php echo file_get_contents("../html/footer.html");?>


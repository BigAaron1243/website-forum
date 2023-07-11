<?php 
session_start();
$title = "Create an account";
require 'header.php';
?>
<form action="registerpost.php" method="post">
	<label>Create an account:<br></label>
	<label>Name:<br></label>
	<input type="text" name="name"><br>
	<label>Password:<br></label>
	<input type="password" name="password"><br>
	<label>Confirm password:<br></label>
	<input type="password" name="confpassword"><br>
	I have read and accept the <a href="/php/privacypolicy.php">Privacy Policy</a><input type="checkbox" name="privacypolicy" value="Yes" /><br>
	I have read and accept the <a href="/php/termsofservice.php">Terms of Service</a><input type="checkbox" name="tos" value="Yes" /><br>
	I have read and understand the <a href="/php/disclaimer.php">Disclaimer</a><input type="checkbox" name="disclaimer" value="Yes" /><br>
	I am over the age of 13<input type="checkbox" name="age" value="Yes" /><br>
	<?php echo file_get_contents('cap.html'); ?>
	<input style="margin-top:8px;" type="submit" value="submit">
</form>

<?php 
if (isset($_GET['code'])) {
	switch ($_GET['code']) {
		case 1:
			echo "name is required.";
			break;
		case 2:
			echo "password is required.";
			break;
		case 3:
			echo "passwords do not match.";
			break;
		case 4:
			echo "this username is already registered.";
			break;
		case 5:
			echo "security question incorrect.";
			break;
		case 6:
			echo "please read the privacy policy, terms of service, and disclaimer.";
			break;
		case 7:
			echo "you may not use this forum if you are under the age of 13.";
			break;
	}
}

?>

<?php echo file_get_contents("../html/footer.html");?>


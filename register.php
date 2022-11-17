<?php 
session_start();
$estr = str_replace("_TITLE", "Create an account", file_get_contents("html/header.html"));
if (isset($_SESSION['username'])) {
	$estr = str_replace("_USERNAME", "Signed in as " . $_SESSION['username'], $estr);
} else {
	$estr = str_replace("_USERNAME", "Not signed in", $estr);
}
echo $estr;
?>
<form action="registerpost.php" method="post">
	<label>Create an account:<br></label>
	<label>Name:<br></label>
	<input type="text" name="name"><br>
	<label>Password:<br></label>
	<input type="password" name="password"><br>
	<label>Confirm password:<br></label>
	<input type="password" name="confpassword"><br>
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
			echo "passwords do not match";
			break;
		case 4:
			echo "this username is already registered";
			break;
	}
}

?>

<?php echo file_get_contents("html/footer.html");?>


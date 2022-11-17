<?php 
session_start();
$estr = str_replace("_TITLE", "Login", file_get_contents("html/header.html"));
if (isset($_SESSION['username'])) {
	$estr = str_replace("_USERNAME", "Signed in as " . $_SESSION['username'], $estr);
} else {
	$estr = str_replace("_USERNAME", "Not signed in", $estr);
}
echo $estr;
?>
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


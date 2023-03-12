<?php 
session_start();
$estr = str_replace("_TITLE", "Home", file_get_contents("html/header.html"));
if (isset($_SESSION['username'])) {
	$estr = str_replace("_USERNAME", "Signed in as " . $_SESSION['username'] . ", <a href='signout.php'>Sign out</a>", $estr);
} else {
	$estr = str_replace("_USERNAME", "<a href='login.php'>Log in</a> or <a href='register.php'>Register</a>", $estr);
}
echo $estr;
?>
<h1 style="text-align: center">Home.</h1>
<?php echo file_get_contents("html/footer.html");?>

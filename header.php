<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="style.css" type="text/css">
		<link rel="icon" href="images/favicon.png" type="image/png">
		<?php echo "<title>$title</title>"?>
	</head>
	<body>
		<header>
			<div class="headercontainer">
				<a href="index.php"><img id="headerimg" src="images/favicon.png"></a>
				<a href="index.php" class="headeritem">Home</a>
				<a href="about.php"class="headeritem">About</a>
				<a href="lord.php" class="headeritem">Javascrip</a>
				<label id='headerrightalign'>
<?php 
if(!empty($_POST['website'])) die();
if (isset($_SESSION['username'])) {
        echo "Signed in as " . $_SESSION['username'] . ", <a href='signout.php'>Sign out</a>";
} else {
        echo "<a href='login.php'>Log in</a> or <a href='register.php'>Register</a>";
}
?>
			</label>
			</div>
		</header>
		<div class="stickyshadow"> </div>
		<div id="content">

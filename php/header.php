<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/style.css" type="text/css">
		<link rel="icon" href="/images/favicon.png" type="image/png">
		<?php echo "<title>$title</title>"?>
	</head>
	<body>
		<header>
			<div class="headercontainer">
				<a href="/index.php" class="headeritem">Home</a>
				<a href="/php/about.php"class="headeritem">About</a>
				<a href="/php/rules.php"class="headeritem">Rules</a>
				<label id='headerrightalign'>
<?php 
if(!empty($_POST['website'])) die();
if (isset($_SESSION['username'])) {
        echo "Signed in as " . $_SESSION['username'] . ", <a href='/php/signout.php'>Sign out</a>";
} else {
        echo "<a href='/php/login.php'>Log in</a> or <a href='/php/register.php'>Register</a>";
}
?>
			</label>
			</div>
		</header>
		<div class="stickyshadow"> </div>
		<div id="content">

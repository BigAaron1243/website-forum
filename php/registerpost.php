<?php 
session_start();

$conn = mysqli_connect("localhost", "formsub", "", "maindb");

if ($conn === false) {
	die("Cant connect to sql database. " . mysqli_connect_error());
}



$name = htmlspecialchars($_REQUEST['name']);
$password = $_REQUEST['password'];
$passwordconf = $_REQUEST['confpassword'];

if ($name == NULL) {
	header('Location: register.php?code=1');
	exit();
}
if ($password == NULL) {
	header('Location: register.php?code=2');
	exit();
}
if ($password != $passwordconf) {
	header('Location: register.php?code=3');
	exit();
}
if ($_REQUEST['security'] != $_SESSION['captcha']) {
	header('Location: register.php?code=5');
	exit();
}

$sqlr = $conn->prepare("SELECT name FROM account WHERE name=?");
$sqlr->bind_param('s', $name);
$sqlr->execute();
$res = $sqlr->get_result();

while ($row = $res->fetch_assoc()) {
	if ($name == $row['name']) {
		header('Location: register.php?code=4');
		exit();
	}
}

$hash_default_salt = password_hash($password, PASSWORD_DEFAULT);

$sqlr = $conn->prepare("INSERT INTO maindb.account (name, pwhash) VALUES (?, ?)");
$sqlr->bind_param('ss', $name, $hash_default_salt);
$sqlr->execute();


//echo $password . " = " . $_REQUEST['password'] ."<br>Hash: " . $hash_default_salt . "<br>Match: " . password_verify($_REQUEST['password'], $hash_default_salt);
//
$_SESSION['username'] = $name;

$title = "Registration successful";
require 'header.php';

$sqlr = $conn->prepare("SELECT name,userid FROM account WHERE name=?");
$sqlr->bind_param('s', $name);
$sqlr->execute();
$res = $sqlr->get_result();

while ($row = $res->fetch_assoc()) {
	if ($name == $row['name']) {
		$_SESSION['userid'] = $row['userid'];
	}
}
echo "Registration Successful, userid: " . $_SESSION['userid'];
echo "<meta http-equiv='refresh' content='1;url=/index.php'>"; 
mysqli_close($conn);

echo file_get_contents("../html/footer.html"); ?>

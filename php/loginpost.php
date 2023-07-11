<?php 
session_start();
$conn = mysqli_connect("localhost", "low", "", "maindb");

if ($conn === false) {
	die("Cant connect to sql database. " . mysqli_connect_error());
}

 

$name = htmlspecialchars($_REQUEST['name']);
$password = $_REQUEST['password'];
$cap = $_REQUEST['security'];

if ($name == NULL) {
	header('Location: login.php?code=1');
	exit();
}
if ($password == NULL) {
	header('Location: login.php?code=2');
	exit();
} 
if ($cap != $_SESSION['captcha']) {
	header('Location: login.php?code=4');
	exit();
}


$sqlr = $conn->prepare('SELECT name,pwhash,userid FROM account WHERE name=?');
$sqlr->bind_param('s', $name);
$sqlr->execute();
$res = $sqlr->get_result();

$login = false;
while ($row = $res->fetch_assoc()) {
	if (password_verify($password, $row['pwhash'])) {
		$login = true;
		$_SESSION['userid'] = $row['userid'];
		$sqlr2 = $conn->prepare('UPDATE account set lastloginip=?;');
		$sqlr2->bind_param('s', $_SERVER["REMOTE_ADDR"]);
		$sqlr2->execute();
	}
}
if ($login == false) {
	header('Location: login.php?code=3');
	exit();
}


$_SESSION['username'] = $name;


$title = "Sign in Successful";
require 'header.php';
echo "Welcome, $name";
echo "<meta http-equiv='refresh' content='1;url=/index.php'>";

mysqli_close($conn);

echo file_get_contents("../html/footer.html"); ?>

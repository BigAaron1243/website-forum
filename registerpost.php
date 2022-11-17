<?php 
session_start();
$estr = str_replace("_TITLE", "What", file_get_contents("html/header.html"));
if (isset($_SESSION['username'])) {
	$estr = str_replace("_USERNAME", "Signed in as " . $_SESSION['username'], $estr);
} else {
	$estr = str_replace("_USERNAME", "Not signed in", $estr);
}
echo $estr;

$conn = mysqli_connect("localhost", "formsub", "", "maindb");

if ($conn === false) {
	die("Cant connect to sql database. " . mysqli_connect_error());
}



$name = $_REQUEST['name'];
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
echo "Registration Successful";

mysqli_close($conn);

echo file_get_contents("html/footer.html"); ?>

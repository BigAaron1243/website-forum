<?php 
session_start();
$estr = str_replace("_TITLE", "Logged in successfully", file_get_contents("html/header.html"));
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

if ($name == NULL) {
	header('Location: login.php?code=1');
	exit();
}
if ($password == NULL) {
	header('Location: login.php?code=2');
	exit();
}

$sqlr = $conn->prepare('SELECT name,pwhash FROM account WHERE name=?');
$sqlr->bind_param('s', $name);
$sqlr->execute();
$res = $sqlr->get_result();

$login = false;
while ($row = $res->fetch_assoc()) {
	if (password_verify($password, $row['pwhash'])) {
		$login = true;
		echo "Welcome, $name";
	}
}
if ($login == false) {
	header('Location: login.php?code=3');
	exit();
}

$_SESSION['username'] = $name;

$hash_default_salt = password_hash($password, PASSWORD_DEFAULT);



mysqli_close($conn);

echo file_get_contents("html/footer.html"); ?>

<?php 
session_start();

$conn = mysqli_connect("localhost", "low", "", "maindb");

if ($conn === false) {
	die("Cant connect to sql database. " . mysqli_connect_error());
}

if (!isset($_SESSION['userid'])) {
	echo "You must be signed in to post";
	exit();
}

$title = htmlspecialchars($_REQUEST['title']);
$content = htmlspecialchars($_REQUEST['content']);

if ($title == NULL) {
	header('Location: post.php?code=1');
	exit();
}
if ($content == NULL) {
	header('Location: post.php?code=2');
	exit();
}
if (strlen($title) > 128) {
	header('Location: post.php?code=3');
	exit();
}
if (strlen($content) > 2048) {
	header('Location: post.php?code=4');
	exit();
}


$dt = date('Y-m-d H:i:s');

$sqlr = $conn->prepare("INSERT INTO maindb.posts (title, content, userid) VALUES (?, ?, ?)");
$sqlr->bind_param('sss', $title, $content, $_SESSION['userid']);
$sqlr->execute();

$dtc = new DateTime($dt);
$dtc->setTimeZone(new DateTimeZone('Australia/Sydney'));
echo $dtc->format('Y-m-d H:i:s');

header("location: viewpost.php?postid=".$conn->query("SELECT postid FROM maindb.posts where userid=".$_SESSION['userid']. " ORDER BY time desc")->fetch_assoc()['postid']);

mysqli_close($conn);



<?php 
session_start();

$conn = mysqli_connect("localhost", "commentsub", "", "maindb");

if ($conn === false) {
	die("Cant connect to sql database. " . mysqli_connect_error());
}

if (!isset($_SESSION['userid'])) {
	header('Location: viewpost.php?code=2&postid='.$_GET['postid']);
	exit();
}

$content = htmlspecialchars($_REQUEST['content']);

if ($content == NULL) {
	header('Location: viewpost.php?code=1&postid='.$_GET['postid']);
	exit();
}
if (strlen($content) > 1024) {
	header('Location: viewpost.php?code=3&postid='.$_GET['postid']);
	exit();
}


$dt = date('Y-m-d H:i:s');

$sqlr = $conn->prepare("INSERT INTO maindb.comments (postid, userid, content, time) VALUES (?, ?, ?, ?)");
$sqlr->bind_param('ssss', $_GET['postid'], $_SESSION['userid'], $_REQUEST['content'], $dt);
$sqlr->execute();

header('Location: viewpost.php?postid='.$_GET['postid']);

mysqli_close($conn);



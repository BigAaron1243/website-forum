<?php 
session_start();

$conn = mysqli_connect("localhost", "postsub", "", "maindb");

if ($conn === false) {
	die("Cant connect to sql database. " . mysqli_connect_error());
}

if (!isset($_SESSION['userid'])) {
	echo "You must be signed in to like";
	exit();
}

if ($conn->query("SELECT postid,userid FROM postlikes WHERE postid=".$_GET['postid']." AND userid=".$_SESSION['userid'])->fetch_assoc() != NULL) {
	header("location: index.php");
	exit();
}
$sqlr = $conn->prepare("INSERT INTO maindb.postlikes (userid, postid) VALUES (?, ?)");
$sqlr->bind_param('ii', $_SESSION['userid'], $_GET['postid']);
$sqlr->execute();


header("location: index.php");

mysqli_close($conn);



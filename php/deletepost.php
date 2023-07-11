<?php 
session_start();
$conn = mysqli_connect("localhost", "low", "", "maindb");

if ($conn === false) {
	die("Cant connect to sql database. " . mysqli_connect_error());
}

$postid = $_GET['postid'];



$sqlr = $conn->prepare('SELECT postid,userid from posts WHERE POSTID=?');
$sqlr->bind_param('i', $postid);
$sqlr->execute();
$res = $sqlr->get_result();

if ($_SESSION['userid'] == $res->fetch_assoc()['userid']) {
	$conn->query("DELETE FROM posts WHERE POSTID=".$postid);
}

mysqli_close($conn);
header("location: ../index.php");

echo file_get_contents("../html/footer.html"); ?>

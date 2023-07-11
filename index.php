<?php 
session_start();

$title = "Forum Homepage";
require 'php/header.php';

$conn = mysqli_connect("localhost", "low", "", "maindb");
$conn2 = mysqli_connect("localhost", "low", "", "maindb");

if ($conn === false) {
	die("Cant connect to sql database. " . mysqli_connect_error());
}

echo "<a href='php/post.php'>Post something</a>";

$sqlr = $conn->prepare('SELECT * from posts ORDER BY postid DESC');
$sqlr->execute();


$posts = $sqlr->get_result();

while ($row = $posts->fetch_assoc()) {
	echo "<div class='post'>";
	$contentvar = $row['content'];
	echo "<a href='php/viewpost.php?postid=". $row['postid'] ."'><h3 class='homecontent'>".$row['title']."</h3></a><p class='homecontent'>".$contentvar."</p>";
	$dt = $row['time'];
	$dtc = new DateTime($dt);
	$dtc->setTimeZone(new DateTimeZone('Australia/Sydney'));
	echo "posted on: " . $dtc->format('Y-m-d H:i:s') . " by <b>" . $conn->query("SELECT name FROM account where USERID=".$row['userid'])->fetch_assoc()['name'] . "</b>";
	if (isset($_SESSION['userid'])) {
		if ($row['userid'] == $_SESSION['userid']) {
			echo " <a href='php/deletepost.php?postid=".$row['postid']."'>Delete this post</a>";
		}
	}
	$ie = mysqli_num_rows($conn2->query("SELECT postid,userid FROM postlikes WHERE postid=".$row['postid']));
	echo "<a href=php/likepost?postid=".$row['postid'] . "></a><br><b>".$ie ."</b>";
	if ($ie == 1) {
		echo " like";
	} else {
		echo " likes";
	}
	if (isset($_SESSION['userid'])) {
		if ($conn2->query("SELECT postid,userid FROM postlikes WHERE postid=".$row['postid']." AND userid=".$_SESSION['userid'])->fetch_assoc() == NULL) {
			echo " <a href='php/likepost.php?postid=".$row['postid']."'>Like this post</a>";
		}
	}
	echo "</div>";
}


mysqli_close($conn2);
mysqli_close($conn);


echo file_get_contents("html/footer.html"); ?>

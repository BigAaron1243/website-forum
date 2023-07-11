<?php 
session_start();

$conn = mysqli_connect("localhost", "low", "", "maindb");

if ($conn === false) {
	die("Cant connect to sql database. " . mysqli_connect_error());
}

$sqlr = $conn->prepare('SELECT * from maindb.posts where postid=?');
$sqlr->bind_param('i', $_GET['postid']);
$sqlr->execute();

$posts = $sqlr->get_result();
$row = $posts->fetch_assoc();

$title = $row['title'];
require 'header.php';

echo "<a href='../index.php'>Back</a>";
echo "<div>";
echo "<h3>".$row['title']."</h3><p>".$row['content']."</p>";
$dt = $row['time'];
$dtc = new DateTime($dt);
$dtc->setTimeZone(new DateTimeZone('Australia/Sydney'));
echo "posted on: " . $dtc->format('Y-m-d H:i:s') . " by <b>" . $conn->query("SELECT name FROM account where USERID=".$row['userid'])->fetch_assoc()['name']. "</b>";
if (isset($_SESSION['userid'])) {
	if ($row['userid'] == $_SESSION['userid']) {
		echo " <a href='deletepost.php?postid=".$row['postid']."'>Delete this post</a>";
	}
}
echo "</div>";
echo "<br><u>Make a comment:</u>";

$getc = $conn->prepare('SELECT * from comments where postid=?');
$getc->bind_param('i', $_GET['postid']);
$getc->execute();
$getc = $getc->get_result();


?>

<?php echo "<form action='commentpost.php?postid=" . $_GET['postid']. "'method='post'>" ?>
<label>Write your Comment:</label><br>
<input type="text" name="content">
<input style="margin-top:8px;" type="submit" value="submit">
</form><br>

<?php

while ($row = $getc->fetch_assoc()) {
	echo "<div style='border-top: solid black 1px'>";
	$dt = $row['time'];
	$dtc = new DateTime($dt);
	$dtc->setTimeZone(new DateTimeZone('Australia/Sydney'));
	echo "<b>". $conn->query("SELECT name FROM account where USERID=".$row['userid'])->fetch_assoc()['name'] . "</b> commented:<br>";
	echo $row['content'] . "<br>";	
	echo "at " .$dtc->format('Y-m-d H:i:s') . "<br>";
	echo "</div>";
}


if (isset($_GET['code'])) {
	switch ($_GET['code']) {
		case 1:
			echo "Please write something";
			break;
		case 3:
			echo "Your comment was too long";
			break;
		case 2: 
			echo "Security question incorrect";
			break;
	}
}

mysqli_close($conn);




echo file_get_contents("../html/footer.html"); ?>

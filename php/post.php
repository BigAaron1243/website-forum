<?php 
session_start();

$title = "Create a Post";
include 'header.php';

if (!isset($_SESSION['userid'])) {
	echo "Please sign in to make a post";
	echo file_get_contents("../html/footer.html");
	exit();
}
?>
		<form action="postpost.php" method="post">
			<label>Create a post:<br></label>
			<label>Title:<br></label>
			<input type="text" name="title"><br>
			<label>Post content:<br></label>
			<textarea name="content" cols="40" rows="5"></textarea><br>
			<input style="margin-top:8px;" type="submit" value="make post">
		</form>
<?php
if (isset($_GET['code'])) {
	switch ($_GET['code']) {
		case 1:
			echo "title is required";
			break;
		case 2:
			echo "post content is required";
			break;
		case 3:
			echo "title too long";
			break;
		case 4:
			echo "post content too long";
			break;
		case 5:
			echo "Security question incorrect";
			break;
	}
}

?>

<?php echo file_get_contents("../html/footer.html");?>


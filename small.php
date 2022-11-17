
<?php
session_start();
$estr = str_replace("_TITLE", "Small example", file_get_contents("html/header.html"));
if (isset($_SESSION['username'])) {
	$estr = str_replace("_USERNAME", "Signed in as " . $_SESSION['username'], $estr);
} else {
	$estr = str_replace("_USERNAME", "Not signed in", $estr);
}
echo $estr;
?>
This is an example of a very small page.
<?php echo file_get_contents("html/footer.html");?>

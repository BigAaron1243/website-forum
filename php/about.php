<?php 
session_start();
$title = "About";
require '../php/header.php'; 
?>
<h1>About this website</h1>
<p>This is a forum created to develop my php, html, css, and mysql skills. Welcome!</p>
<?php echo file_get_contents("../html/footer.html");?>

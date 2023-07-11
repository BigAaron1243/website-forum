<?php 
session_start();
$title = "404 File not found";
require '../php/header.php'; 
?>
<h1 style="text-align: center">404.</h1>
<p style="text-align: center">The page you are looking for does not exist</p>
<?php echo file_get_contents("../html/footer.html");?>

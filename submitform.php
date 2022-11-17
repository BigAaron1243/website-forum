<?php echo str_replace("_TITLE", "What", file_get_contents("html/header.html"));


$conn = mysqli_connect("localhost", "formsub", "indeterminatepw", "myDB");

if($conn === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

$first_name =  preg_replace( '/[^a-z0-9 ]/i', '', $_REQUEST['name']);


$sql = "INSERT INTO college VALUES ('$first_name')";

if(mysqli_query($conn, $sql)){
	echo nl2br("\n$first_name");
} else{
	echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
}

mysqli_close($conn);

echo file_get_contents("html/footer.html");
?>

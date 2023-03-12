<?php
session_start();
$msg = '';

if (isset($_REQUEST['input']) && sizeof($_REQUEST['input']) > 0) {
// If the captcha is valid
if ($_POST['input'] == $_SESSION['captcha']) {
$msg = '<span style="color:green">SUCCESSFUL!!!</span>';
} else {
$msg = '<span style="color:red">CAPTCHA FAILED!!!</span>';
}
}
?>

    <form method="POST" action=" <?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="input"/>
        <input type="hidden" name="flag" value="1"/>
        <input type="submit" value="Submit" name="submit"/>
    </form>

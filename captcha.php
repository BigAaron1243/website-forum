<?php
session_start();
$captcha = rand(10000, 99999);
$_SESSION['captcha'] = $captcha;
$im = imagecreatetruecolor(80, 24);
if (rand(1, 2) > 1) {
	$bd = 0;
	$bl = 127;
	$fd = 127;
	$fl = 255;
} else {
	$bd = 127;
	$bl = 255;
	$fd = 0;
	$fl = 127;
}
$bg = imagecolorallocate($im, rand($bd, $bl), rand($bd, $bl), rand($bd, $bl));
$fg = imagecolorallocate($im, rand($fd, $fl), rand($fd, $fl), rand($fd,$fl));
imagefill($im, 0, 0, $bg);
imagestring($im, rand(1, 7), rand(1, 7),rand(1, 7),  $captcha, $fg);

for ($i=0; $i<30; $i++) {
	imagesetthickness($im, 0.5);
	imagearc(
		$im, rand(1,100), rand(1,100), rand(1,300), rand(1,300), rand(1,300), rand(1,300), imagecolorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255)));
}
$im = imagescale($im, rand(160, 240), rand(48, 72), IMG_NEAREST_NEIGHBOUR);
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);
?>

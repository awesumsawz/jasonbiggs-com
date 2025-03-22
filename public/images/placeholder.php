<?php
// Simple placeholder image generator
$width = isset($_GET['width']) ? intval($_GET['width']) : 800;
$height = isset($_GET['height']) ? intval($_GET['height']) : 450;
$text = isset($_GET['text']) ? $_GET['text'] : 'Placeholder Image';

// Create the image
$image = imagecreatetruecolor($width, $height);

// Set colors
$bg_color = imagecolorallocate($image, 240, 240, 240);
$text_color = imagecolorallocate($image, 80, 80, 80);
$border_color = imagecolorallocate($image, 200, 200, 200);

// Fill the background
imagefill($image, 0, 0, $bg_color);

// Add border
imagerectangle($image, 0, 0, $width - 1, $height - 1, $border_color);

// Add text
$font_size = 5;
$text_box = imagettfbbox($font_size, 0, 5, $text);
$text_width = $text_box[2] - $text_box[0];
$text_height = $text_box[7] - $text_box[1];
$x = ($width - $text_width) / 2;
$y = ($height - $text_height) / 2;

// Draw text
imagestring($image, $font_size, $x, $y, $text, $text_color);

// Output the image
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image); 
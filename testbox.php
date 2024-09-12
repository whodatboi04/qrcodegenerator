<?php
// Set the TrueType font file and size
$fontFile = 'path/to/your/font.ttf';
$fontSize = 14;

// Set the text string
$text = 'Hello, World!';

// Create an image with a white background
$imageWidth = 300;
$imageHeight = 100;
$image = imagecreatetruecolor($imageWidth, $imageHeight);
$backgroundColor = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $backgroundColor);

// Set the text color
$textColor = imagecolorallocate($image, 0, 0, 0);

// Get the bounding box of the text
$bbox = imagettfbbox($fontSize, 0, $fontFile, $text);

// Calculate the width and height of the bounding box
$width = $bbox[4] - $bbox[6];
$height = $bbox[1] - $bbox[7];

// Calculate the position to center the text
$x = ($imageWidth - $width) / 2;
$y = ($imageHeight - $height) / 2;

// Draw the text on the image
imagettftext($image, $fontSize, 0, $x, $y, $textColor, $fontFile, $text);

// Draw a border around the bounding box
$borderColor = imagecolorallocate($image, 0, 0, 0);
imagerectangle($image, $x, $y, $x + $width, $y + $height, $borderColor);

// Output the image
header('Content-Type: image/png');
imagepng($image);

// Free up memory
imagedestroy($image);
?>
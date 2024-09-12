<?php 

 ini_set('memory_limit', '1024M'); // or you could use 1G



ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);


require_once("configFile_PSBIM.php");
include('fpdf/fpdf.php');
include('phpqrcode/qrlib.php');

ob_start();
session_start();
$name= $_SESSION['Fullname'];
header('Content-type: image/jpeg');



$font=realpath('arialbd.ttf');

$image=imagecreatefromjpeg("format.jpg");

$color=imagecolorallocate($image, 255, 255, 255);

$bbox = imagettfbbox(200, 0, $font, $name);
$center1 = (imagesx($image) / 2) - (($bbox[2] - $bbox[0]) / 2);


imagettftext($image, 50, 0, $center1, 10, $color,$font, $name);


$text123=  $_SESSION['seatcode'];
imagettftext($image, 50, 0, 10, 10, $color,$font, $text123);



imagejpeg($image, "qrtemp.jpg");
imagedestroy($image);


$text =  $_SESSION['qrlink'];

$path = 'QRtemp/Qr.png';

// $ecc stores error correction capability('L')
$ecc = 'L';
$pixel_Size = 10;
$frame_Size = 10;
  
// Generates QR Code and Stores it in directory given
QRcode::png($text, $path, $ecc, $pixel_Size, $frame_Size);


$pdf = new FPDF();
$pdf->AddPage('L','A5');
$pdf->Image("format.jpg",0,0,210,148);
//$pdf->Image("QRtemp/Qr.png",60,40,100,100);
$pdf->Image("QRtemp/Qr.png",60,40,20,20);



ob_end_clean();
$pdf->Output();



if ($error = error_get_last()) {
    print_r($error);
}



?>






<?php 

ini_set('memory_limit', '1024M'); // or you could use 1G

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);


include("configFile_PSBIM.php");

require('fpdf/fpdf.php');
include('phpqrcode/qrlib.php');

session_start();
ob_start();
//header('Content-type: image/jpeg');
header('Content-type: application/pdf'); // Change content type to PDF



$font=realpath('arialbd.ttf');

$image=imagecreatefromjpeg("new_permit.jpg");

$color=imagecolorallocate($image, 51, 51, 102);


$firstname= $_SESSION['firstname'];
imagettftext($image, 30, 0, 430, 410, $color,$font, $firstname);


$middlename = $_SESSION['middle_initial'];
imagettftext($image, 30, 0, 430, 660, $color,$font, $middlename);

$extensionname= $_SESSION['extension_name'];
imagettftext($image, 30, 0, 1150, 660, $color,$font, $extensionname);


$lastname = $_SESSION['lastname'];
imagettftext($image, 30, 0, 430, 530, $color,$font, $lastname);


$mydate = $_SESSION['mydate'];
imagettftext($image, 30, 0, 200, 300, $color,$font, $mydate);



$varBldgRoom=  $_SESSION['bldg_room'];
imagettftext($image, 30, 0, 430, 780, $color,$font, $varBldgRoom);

$varSeatCode=  $_SESSION['seatcode'] ;
imagettftext($image, 30, 0, 430, 910, $color,$font, $varSeatCode);


imagejpeg($image, "certificate.jpg");
imagedestroy($image);

$text =  $_SESSION['qrlink'];

echo $_SESSION['qrlink'];

$path = 'QRtemp/Qr.png';


// $ecc stores error correction capability('L')
$ecc = 'L';
$pixel_Size = 10;
$frame_Size = 1;
  
// Generates QR Code and Stores it in directory given
QRcode::png($text, $path, $ecc, $pixel_Size, $frame_Size);


$pdf = new FPDF();
$pdf->AddPage('L','A5');
$pdf->Image("certificate.jpg",0,0,210,148);
$pdf->Image("QRtemp/Qr.png",169,7,35,35);
ob_end_clean();
$pdf->Output();

//Output the PDF content as a string
$pdfContent = $pdf->Output('', 'S');

// Provide a name for the downloaded file
$fileName = "PSBIM_EXAM_PERMIT.pdf";

// Set appropriate headers for download
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('Content-Length: ' . strlen($pdfContent));

// Output the PDF content
echo $pdfContent;
exit;

?>






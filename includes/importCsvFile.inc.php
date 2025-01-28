<?php

session_start();

define('dbhost', 'localhost');
define('dbuser', 'root');
define('dbpass', '');
define('db_name', 'pcporg_psbimattendance');

try {
    $conn = new PDO("mysql:host=" . dbhost . ";dbname=" . db_name, dbuser, dbpass);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if a file was uploaded 
if (isset($_POST['upload_file'])) {
    $file = $_FILES['csv_file']['tmp_name'];

    if (($handle = fopen($file, 'r')) !== false) {
        // Skip the first row 
        fgetcsv($handle);

        $stmt = $conn->prepare("INSERT INTO psbim_tbl (lastname, firstname, middle_initial, bldg_room, seatcode, qrlink) 
                                VALUES (:lastname, :firstname, :middle_initial, :bldg_room, :seatcode, :qrlink)");

        while (($data = fgetcsv($handle, 0, ',')) !== false) {
        
            $lastname = $data[0];
            $firstname = $data[1];
            $middle_initial = $data[2];
            $bldg_room = $data[3];
            $seatcode = $data[4];
            $qrlink = $data[5];

            $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
            $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
            $stmt->bindValue(':middle_initial', $middle_initial, PDO::PARAM_STR);
            $stmt->bindValue(':bldg_room', $bldg_room, PDO::PARAM_STR);
            $stmt->bindValue(':seatcode', $seatcode, PDO::PARAM_STR);
            $stmt->bindValue(':qrlink', $qrlink, PDO::PARAM_STR);
            $stmt->execute();
        }

        fclose($handle);
        $_SESSION['message'] = "CSV imported successfully.";
    } else {
        $_SESSION['message'] = "Failed to open the file.";
    }
} else {
    $_SESSION['message'] = "No file uploaded.";
}

// Redirect back to the import page
header("Location: ../ImportExaminee.php");
exit();

?>

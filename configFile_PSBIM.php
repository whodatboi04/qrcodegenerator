<?php

define('dbhost','localhost');
define('dbuser','root');
define('dbpass','');
define('db_name','pcporg_psbimattendance');



try {
    $conn = new PDO("mysql:host=".dbhost.";dbname=".db_name,dbuser,dbpass);
} catch (PDOException $e) {
    exit("Error".$e->getMessage());
}



if(isset($_GET['seatcode']))
{

    session_start();

    $varSeatCode = $_GET['seatcode'];

    $statement = $conn->prepare("SELECT * FROM psbim_tbl WHERE seatcode = :seatcode");
    $statement->bindparam(":seatcode",$varSeatCode);
    $statement->execute();
    $fetchdata = $statement->fetch();

    $myDate = date('M d Y');

    
    $_SESSION['lastname'] = $fetchdata['lastname'];
    $_SESSION['firstname'] = $fetchdata['firstname'];
    $_SESSION['middle_initial'] = $fetchdata['middle_initial'];
    $_SESSION['extension_name'] = $fetchdata['extension_name'];
    $_SESSION['bldg_room'] = $fetchdata['bldg_room'];
    $_SESSION['seatcode'] = $varSeatCode;
    $_SESSION['qrlink'] = $fetchdata['qrlink'];
    $_SESSION['mydate'] = $myDate;

    echo '<script>window.location.href = "cert.php";</script>';
    
}



?>
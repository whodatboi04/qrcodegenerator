<?php

define('dbhost','localhost');
define('dbuser','pcporg_psbimuser');
define('dbpass','2024pcP2024');
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

    echo  $_SESSION['lastname'] . "<br/>";
    echo  $_SESSION['firstname'] . "<br/>";
    echo  $_SESSION['middle_initial']. "<br/>";
    echo  $_SESSION['extension_name']. "<br/>";
    echo  $_SESSION['seatcode']. "<br/>";
    echo  $_SESSION['qrlink']. "<br/>";
    echo  $_SESSION['mydate']. "<br/>";

    echo '<script>window.location.href = "cert.php";</script>';
    
}



?>
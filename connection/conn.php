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

?>
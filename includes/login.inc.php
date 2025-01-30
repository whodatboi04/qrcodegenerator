<?php

session_start();

define('dbhost','localhost');
define('dbuser','root');
define('dbpass','');
define('db_name','pcporg_psbimattendance');

try {
    $conn = new PDO("mysql:host=".dbhost.";dbname=".db_name,dbuser,dbpass);
} catch (PDOException $e) {
    exit("Error".$e->getMessage());
}

error_reporting(E_ALL);
ini_set('display_errors', 1);


if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindparam(":email", $email);
    $stmt->execute();
   
    //Get Data

    $user = $stmt->fetch();

    //Check if user exsist
    if($user){
        //Password Match
        if($user && password_verify($password, $user['password'])){
            $_SESSION['userID'] = $user['userID'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['access'] = $user['access'];

            if($user['access'] === 'Admin'){
                header("Location:../Dashboard.php");
                exit();
            }

            header("Location:../ImportExaminee.php");
            exit();
        }else{
            $_SESSION['message'] = "Invalid email or password.";
            header("Location: ../index.php");
            exit();
        }
    }else{
        $_SESSION['message'] = "Invalid email or password.";
        header("Location: ../index.php");
        exit();
    }
}
?>
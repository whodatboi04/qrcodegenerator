<?php

session_start();
include('../connection/conn.php');


if(isset($_POST['update-profile'])){
    $userID = $_POST['userID'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $newPassword = $_POST['newPassword'];

    $result = $conn->prepare("SELECT password FROM users WHERE userID = :userID");
    $result->bindParam(':userID', $userID, PDO::PARAM_INT);
    $result->execute();
    $user = $result->fetch(PDO::FETCH_ASSOC);

    if(!$user){
        $_SESSION['message'] = "User does not exist.";
        header("Location: ../UpdateProfile.php");
        exit();
    }

    $hashedPassword = !empty($newPassword) ? password_hash($newPassword, PASSWORD_DEFAULT) : $user['password'];

    $stmt = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, password = :password WHERE userID = :userID");
    $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
    $stmt->execute();
    
    $_SESSION['message'] = "Profile updated successfully.";
    header("Location: ../Profile.php");
    exit();        
}


?>

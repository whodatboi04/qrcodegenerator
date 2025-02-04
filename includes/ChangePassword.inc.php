<?php 

session_start();

include('../connection/conn.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['update_password'])){
    $userID = $_POST['id'];
    $oldPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmNewPass = $_POST['confirm_password'];

    //Check if matches the oldPassword
    $stmt = $conn->prepare("SELECT password FROM users WHERE userID = :userID");
    $stmt->bindParam(":userID", $userID);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if($result){
        $hashedPassword = $result['password'];
        $oldPassword = trim($oldPassword);

        if(password_verify($oldPassword, $hashedPassword)){
            if($oldPassword == $newPassword){
                $_SESSION['message'] = "New password must be different from old password.";
                header('Location: ../ChangePassword.php');
                exit();
            }

            if($newPassword !== $confirmNewPass){
                $_SESSION['message'] = "New password and confirm password do not match.";
                header("Location: ../ChangePassword.php");
                exit();
            }else{
                $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $query = $conn->prepare("UPDATE users SET password = :password");
                $query->bindParam(":password", $hashedNewPassword);
                $query->execute();

                $_SESSION['message'] = "Password changed successfully.";
                header("Location: ../Profile.php");
                exit();
            }
        }else{
            $_SESSION['message'] = "Current Password does not match.";
            header('Location: ../ChangePassword.php');
            exit();
        }
    }

}

?>
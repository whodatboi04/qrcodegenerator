<?php 

session_start();

include('../connection/conn.php');


//Edit user
if(isset($_POST['edit_user'])){

    $userID = $_POST['userID'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $access = $_POST['access'];
    $newPassword = $_POST['newPassword'];

    $result = $conn->prepare("SELECT password FROM users WHERE userID = :userID");
    $result->bindParam(":userID", $userID);
    $result->execute();
    $user = $result->fetch(PDO::FETCH_ASSOC);

    if(!$user){
        $_SESSION['message'] = "User does not exist.";
        header("Location: ../editUser.php?userID=$userID");
        exit();
    }

    $hashedPassword = !empty($newPassword) ? password_hash($newPassword, PASSWORD_DEFAULT) : $user['password'];

    $stmt = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, access = :access, password = :password WHERE userID = :userID");
    $stmt->bindParam(":userID", $userID);
    $stmt->bindParam(":firstname", $firstname);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":access", $access);
    $stmt->bindParam(":password", $hashedPassword);
    $stmt->execute();

    $_SESSION['message'] = "User updated successfully.";
    header("Location: ../Accounts.php");
    exit();    
}

//Archive user
if(isset($_POST['archive'])){

    $userID = $_POST['userID'];

    $stmt = $conn->prepare("UPDATE users SET status = 'inactive' WHERE userID = :userID");
    $stmt->bindParam(":userID", $userID);
    $stmt->execute();

    $_SESSION['message'] = "User archived successfully.";
    header("Location: ../Accounts.php");
    exit();
}

//Restore user
if(isset($_GET['restoreID'])){

    $userID = $_GET['restoreID'];

    $stmt = $conn->prepare("UPDATE users SET status = 'active' WHERE userID = :userID");
    $stmt->bindParam(":userID", $userID);
    $stmt->execute();

    $_SESSION['message'] = "User restored successfully.";
    header("Location: ../Accounts.php");
    exit();
}

//Delete user Permanently
if(isset($_POST['delete'])){
    $userID = $_POST['userID'];

    $stmt = $conn->prepare("DELETE FROM users WHERE userID = :userID");
    $stmt->bindParam(":userID", $userID);
    $stmt->execute();

    $_SESSION['message'] = "User deleted successfully.";
    header("Location: ../trash.php");
    exit();
}




?>
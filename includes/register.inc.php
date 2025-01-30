<?php

session_start();

include('../connection/conn.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['register'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $access = $_POST['access'];

    // Check if the email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindValue(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $_SESSION['message'] = "User already exists";
        header("Location: ../register.php");
        exit();
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        $_SESSION['message'] = "Passwords do not match";
        header("Location: ../register.php");
        exit();
    } else {
        // Hash the password and insert the user into the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert user data into the database
        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, access, status) VALUES(:firstname, :lastname, :email, :password, :access, 'active')");
        $stmt->bindValue(":firstname", $firstname, PDO::PARAM_STR);
        $stmt->bindValue(":lastname", $lastname, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":password", $hashedPassword, PDO::PARAM_STR);
        $stmt->bindValue(":access", $access, PDO::PARAM_STR); 
        
        $stmt->execute();
        $stmt->closeCursor();
        $_SESSION['message'] = "Successfuly Registered";
        header("Location: ../index.php");
    }
}
?>

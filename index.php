<?php

session_start();

if(isset($_SESSION['userID'])){
    session_unset();
    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Login</h1>
            <p class="error-message"><?php include('message.php') ?></p>
        </div>
        <form action="includes/login.inc.php" method="POST">
            <div class="form-group">
                <label for="username">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <input type="submit" name="login" value="Login">
            </div>
        </form>
        <div class="note">
            <p>If you don’t have an account, please request from Admin.</p>
        </div>
    </div>
</body>
</html>

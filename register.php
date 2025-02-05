<?php

//session start included on navbar.php

include('assets/navbar.php');

if(!isset($_SESSION['userID'])){
   header('Location: index.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <title>Register Interface</title>
</head>
<body>
    <div class="register-container">
        <div class="register-wrapper">
            <div class="register-header">
                <h1>Register</h1>
                <p class="error-message"><?php include('message.php') ?></p>
            </div>
            <form action="includes/register.inc.php" method="POST">
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" placeholder="Enter your first name" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" placeholder="Enter your last name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
                </div>
                <div class="form-group">
                    <label for="access">Account Role</label>
                    <select name="access" >
                        <option value="" disabled selected>-- Select Role --</option>
                        <option value="SuperAdmin">Super Administrator</option>
                        <option value="Admin">Administrator</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="register" value="Register">
                </div>
            </form>
        </div>
    </div>
    
    <?php include('assets/footer.php') ?>
</body>
</html>

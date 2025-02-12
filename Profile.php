<?php

include('assets/navbar.php');

if (
    !isset($_SESSION['userID']) || 
    !isset($_SESSION['status']) || $_SESSION['status'] !== 'active'
){
    header("Location: index.php");
    exit();
}

$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$email = $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Profile.css">
    <title>Document</title>
</head>
<body>
    <section class="profile-wrapper">
        <div class="profile-container">
            <span class="success-message"><?php include('message.php'); ?></span>
            <div class="profile-header">
                <div class="user-info">
                    <h1><?php echo $firstname . ' ' . $lastname; ?></h1>
                    <p><?php echo $email; ?></p>    
                </div>
            </div>

            <div class="profile-sections">

                <div class="profile-section">
                    <h2>Recent Activities</h2>
                    <ul>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </li>
                    </ul>
                </div>

                <div class="profile-section">
                    <h2>Settings</h2>
                    <p><a href="ChangePassword.php">Change Password</a></p>
                    <p><a href="update-profile.php">Update Profile</a></p>
                    <div class="logout">
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php require('assets/footer.php'); ?>
</body>
</html>
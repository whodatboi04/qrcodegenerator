<?php

include('assets/navbar.php');


//Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: index.php");
    exit();
}

$userID = $_SESSION['userID'];

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ChangePassword.css">
    <link href="pcp-logo.png" rel="icon">
    <title>Change Password</title>
</head>
<body>
    <section class="changepass-wrapper">
        <div class="change-password">
            <span class="error-message"><?php include('message.php'); ?></span>
            <h2>Change Password</h2>
            <form action="includes/ChangePassword.inc.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $userID;  ?>">
                <label for="current-password">Current Password</label>
                <input type="password" id="current-password" name="current_password" required>

                <label for="new-password">New Password</label>
                <input type="password" id="new-password" name="new_password" required>

                <label for="confirm-password">Confirm New Password</label>
                <input type="password" id="confirm-password" name="confirm_password" required>

                <button type="submit" name="update_password">Update Password</button>
            </form>
        </div>
    </section>

    <?php include('assets/footer.php'); ?>
</body>
</html>
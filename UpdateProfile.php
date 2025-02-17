<?php

include('assets/navbar.php');
include('connection/conn.php');

//Check if the user is logged in


$userID = $_SESSION['userID'];

$stmt = $conn->prepare("SELECT * FROM users WHERE userID = :userID");
$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$firstname = htmlspecialchars($result['firstname']);
$lastname = htmlspecialchars($result['lastname']);
$email = htmlspecialchars($result['email']);
$access = htmlspecialchars($result['access']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/UpdateProfile.css">
    <link href="pcp-logo.png" rel="icon">
    <title>Update Profile</title>
</head>
<body>
    <section>
        <div class="edit-container">
            <h1>Update Profile</h1>
            <form method="POST" action="includes/UpdateProfile.inc.php">
                <input type="hidden" name="userID" value="<?php echo $userID; ?>">

                <div>
                    <label for="firsname">First Name:</label>
                    <input type="text" name="firstname" value="<?php echo $firstname; ?>" required>
                </div>

                <div>
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" value="<?php echo $lastname; ?>" required>
                </div>

                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="<?php echo $email; ?>" required>
                </div>

                <div>
                    <label for="newPassword">New Password:</label>
                    <input type="password" name="newPassword" >
                </div>

                <button type="submit" name="update-profile">Save Changes</button>
            </form>
        </div>
    </section>
    
    <?php include('assets/footer.php') ?>

</body>
</html>
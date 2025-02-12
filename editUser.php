<?php

session_start();
include('connection/conn.php');

//Check if the user is logged in


$userID = $_GET['userID'];

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
    <link rel="stylesheet" href="css/editUser.css">
    <title>Document</title>
</head>
<body>
    <section>
        <div class="edit-container">
            <h1>Edit User</h1>
            <form method="POST" action="includes/accountAction.inc.php">
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
                    <input type="text" name="email" value="<?php echo $email; ?>" required>
                </div>
                
                <div>
                    <label for="access">Role:</label>
                    <input type="text" name="access" value="<?php echo $access; ?>" required>
                </div>

                <div>
                    <label for="newPassword">New Password:</label>
                    <input type="password" name="newPassword" >
                </div>

                <button type="submit" name="edit_user">Save Changes</button>
                <a href="Accounts.php">Cancel</a>
            </form>
        </div>
    </section>
    
</body>
</html>
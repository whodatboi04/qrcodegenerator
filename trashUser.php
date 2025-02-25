<?php

session_start();
include('connection/conn.php');

//Check if the user is logged in


$userID = $_GET['userID'];

$stmt = $conn->prepare("SELECT * FROM users WHERE userID = :userID");
$stmt->bindParam(':userID', $userID);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$firstname = htmlspecialchars($result['firstname']);
$lastname = htmlspecialchars($result['lastname']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/trashUser.css">
    <title>Document</title>
</head>
<body>
    <section>
        <div class="edit-container">
            <p>Are you sure you want to archive this user?</p>
            <form method="POST" action="includes/accountAction.inc.php">
                <input type="hidden" name="userID" value="<?php echo $userID; ?>">

                <div>
                    <h1><?php echo $firstname . ' ' . $lastname; ?></h1>
                </div>

                <button type="submit" name="archive">Yes</button>
                <a href="Accounts.php">Cancel</a>
            </form>
        </div>
    </section>
    
</body>
</html>
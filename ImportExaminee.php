<?php
//session start included on navbar.php

include('assets/navbar.php');


if (
    !isset($_SESSION['userID']) || 
    !isset($_SESSION['access']) || $_SESSION['access'] !== 'SuperAdmin'  ||
    !isset($_SESSION['status']) || $_SESSION['status'] !== 'active'
){
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ImportExaminee.css">
    <link href="pcp-logo.png" rel="icon">

    <title>Import Examinee CSV</title>
</head>
<body>
    <div class="import-wrapper">
        <div class="import-container">
            <form method="POST" action="includes/importCsvFile.inc.php" enctype="multipart/form-data"> 
                <div class="import-header">
                    <h1>Import Examinee</h1>
                </div>
                <div class="import-button">
                    <a href="sampleCsv.csv" class="csv-button" download>Download Sample CSV</a>
                    <span>(Please make sure the file is csv UTF-8)</span>
                    <input type="file" name="csv_file" required />
                    <button type="submit" name="upload_file" class="upload-btn">Upload</button>
                </div>
            </form>
        </div>
    </div>
    <?php include('assets/footer.php') ?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Examinee CSV</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .import-container {
            width: 400px;
            background-color: #ffffff;
            border: 1px solid #8b0000;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            text-align: center;
        }

        .import-header {
            margin-bottom: 20px;
        }

        .import-header h1 {
            color: #8b0000;
            font-size: 24px;
            margin: 0;
        }

        .import-button {
            padding: 10px 20px;
            background-color: #8b0000;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
            text-decoration: none;
            display: flex;
            flex-direction:column;
            gap: 1rem;

        }

        .import-button:hover {
            background-color: #a00000;
        }

        .logout-link {
            display: block;
            margin-top: 15px;
            color: #8b0000;
            text-decoration: none;
        }

        .logout-link:hover {
            text-decoration: underline;
        }

        .upload-btn{
            background-color: #424242;
            color: #fff;    
            padding: 10px;
            border-radius: 15px;
            border:none;
        }

        .upload-btn:hover{
            background-color: #2E2E2E;
        }
        
        .upload-btn:active{
            background-color: #000;
        }

        .csv-button{
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="import-container">
        <form method="POST" action="includes/importCsvFile.inc.php" enctype="multipart/form-data"> 
            <div class="import-header">
                <h1>Import Examinee</h1>
            </div>
            <div class="import-button">
                <a href="sampleCsv.csv" class="csv-button" download>Download Sample CSV</a>
                <input type="file" name="csv_file" required />
                <button type="submit" name="upload_file" class="upload-btn">Upload</button>
            </div>
        </form>
        
        <a href="logout.php" class="logout-link">Logout</a>
    </div>
</body>
</html>

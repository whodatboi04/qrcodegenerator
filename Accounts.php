<?php
//session start included on navbar.php

include('assets/navbar.php');
include('connection/conn.php');

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Accounts.css">
    <!-- Datatable CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.min.css">
    <!-- Datatable CDN END -->
    <title>Accounts</title>
</head>
<body>
    
    <section class="section-container">
        <div class="content-container">
            <div class="table-wrapper">
                <div class="main-table w3-animate-left">
                    <div class="table-header">
                        <h1>Dashboard</h1>
                    </div>
                    <table id="myTable" class="table table-striped" style="width:100%; font-size:15px;">
                        <thead>
                            <tr>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch Data
                            $stmt = $conn->prepare("SELECT * FROM users ORDER BY userID");
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Check and Loop Through Results
                            if ($result) {
                                foreach ($result as $row) {
                                    echo '<tr>';
                                        echo '<td>' . htmlspecialchars($row['lastname']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['firstname']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['access']) . '</td>';
                                        echo '<td> <span class="status">' . htmlspecialchars($row['status']) . '</span> </td>';

                                    echo '</tr>';
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php include('assets/footer.php') ?>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true,
                order: [],
            });
        });
    </script>
</body>
</html>
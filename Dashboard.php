<?php
// Required Includes
include('assets/navbar.php');
include('connection/conn.php');
include('phpqrcode/qrlib.php');

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Datatable CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.min.css">
    <!-- Datatable CDN END -->
    <link rel="stylesheet" href="css/Dashboard.css">
    <title>Dashboard</title>
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
                                <th>SeatCode</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Initial</th>
                                <th>Building Room</th>
                                <th>Attendance Form</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch Data
                            $stmt = $conn->prepare("SELECT * FROM psbim_tbl ORDER BY id");
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Check and Loop Through Results
                            if ($result) {
                                foreach ($result as $row) {
                                    echo '<tr>';
                                        echo '<td>' . htmlspecialchars($row['seatcode']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['lastname']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['firstname']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['middle_initial']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['bldg_room']) . '</td>';
                                        echo '<td>';
                                            echo '<a href="'. $row['qrlink'] .'" target="blank"> View Form </a>';
                                        echo '</td>';
                                    echo '</tr>';
                                }
                            } 
                            ?>
                            <tfoot>
                                <tr>
                                    <th>SeatCode</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Initial</th>
                                    <th>Building Room</th>
                                    <th>Attendance Form</th>
                                </tr>
                            </tfoot>
                        </tbody>
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

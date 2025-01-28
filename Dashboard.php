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
                        <h1>User Accounts</h1>
                        <button type="button" href="#addnewModal" class="btn btn-success add-new" data-toggle="modal" style="font-weight:bold;">
                            <i class="fa fa-plus"></i> Add New
                        </button>
                    </div>
                    <table id="myTable" class="table table-striped" style="width:100%; font-size:15px;">
                        <thead>
                            <tr>
                                <th>SeatCode</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Initial</th>
                                <th>Building Room</th>
                                <th>QR Code</th>
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

                                    $text =  $row['qrlink'];

                                    $path = 'QRtemp/Qr.png';

                                    // $ecc stores error correction capability('L')
                                    $ecc = 'L';
                                    $pixel_Size = 10;
                                    $frame_Size = 10;
                                    
                                    // Generates QR Code and Stores it in directory given
                                    QRcode::png($text, $path, $ecc, $pixel_Size, $frame_Size);
                                   

                                    echo '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="6" style="text-align:center;">No records found</td></tr>';
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SeatCode</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Initial</th>
                                <th>Building Room</th>
                                <th>QR Code</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>

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

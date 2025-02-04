<?php

session_start();

?>

<!-- Include Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<nav>
    <ul>
        <li>
            <a href="ImportExaminee.php">
                <img src="pcp-logo.png" alt="PCP Logo">
            </a>
        </li>
        <div class="nav-button">
            <?php if($_SESSION['access'] === 'SuperAdmin'){ ?>
                <li>
                    <a href="ImportExaminee.php">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>

                <li>
                    <a href="Dashboard.php">
                        <i class="fas fa-chart-line"></i> Dashboard
                    </a>
                </li>

                <li>
                    <a href="register.php">
                        <i class="fas fa-user-plus"></i> Register Account
                    </a>
                </li>

                <li>
                    <a href="Accounts.php">
                        <i class="fas fa-users"></i> Accounts
                    </a>
                </li>

                <li>
                    <a href="Profile.php">
                        <i class="fa-solid fa-user"></i> Profile
                    </a>
                </li> 
            <?php } else { ?>
                <li>
                    <a href="Dashboard.php">
                        <i class="fas fa-chart-line"></i> Dashboard
                    </a>
                </li>

                <li>
                    <a href="logout.php">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li> 
            <?php } ?>
        </div>
    </ul>
</nav>

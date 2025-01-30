<?php

session_start();

?>

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
                    <a href="ImportExaminee.php">Home</a>
                </li>

                <li>
                    <a href="Dashboard.php">Dashboard</a>
                </li>

                <li>
                    <a href="register.php">Register Account</a>
                </li>

                <li>
                    <a href="Accounts.php">Accounts</a>
                </li>

                <li>
                    <a href="logout.php">Logout</a>
                </li> 
            <?php } else { ?>
                <li>
                    <a href="Dashboard.php">Dashboard</a>
                </li>

                <li>
                    <a href="logout.php">Logout</a>
                </li> 
            <?php } ?>

        </div>
    </ul>
</nav>
<?php
include_once "../../global/php/db-functions.php";
include_once "view_loader.php";
maintain_session();
//redirect_to_login();
//restrict_to_staff();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HURGADA-GRND-HOTEL</title>
    <link rel="icon" href="../../resources/img/pretty stuff/hurghada-beach.jpg">
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='../../global/css/bootstrap-5.0.2-dist/css/bootstrap.css'>
    <script src='../../global/css/bootstrap-5.0.2-dist/js/bootstrap.js'></script>
    <script src='../../global/js/font-awesome.js'></script>
    <!-- Main template CSS File -->
    <link rel='stylesheet' href='../../global/template/template.css' />
    <link rel='stylesheet' href='./style.css' />
    <!-- Main JS File -->
    <script src='../../global/template/template.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="../../global/js/ajax_functions.js"></script>
</head>

<body class='d-flex flex-column min-vh-100'>
    <!--=============== Header ===============-->
    <div class="header" id="header">
        <div class="container">
            <div class="links">
                <span id="icon" class="icon" onclick="showbar()">
                    <i class='bx bx-menu-alt-left'></i>
                </span>
                <div class="items" id="items">
                    <span class="container">
                        <span><a href="../HomePage/index.php#home">Home</a></span>
                    </span>
                    <span class="container">
                        <span><a href="../HomePage/index.php#rooms">Rooms</a></span>
                    </span>
                    <span class="container">
                        <span><a href="../HomePage/index.php#dine">Dining</a></span>
                    </span>
                    <span class="container">
                        <span><a href="../HomePage/index.php#exp">Experience</a></span>
                    </span>
                    <span class="container">
                        <span><a href="../HomePage/index.php#loc">Location</a></span>
                    </span>
                    <span class="container">
                        <span><a href="../HomePage/index.php#about">About</a></span>
                    </span>
                </div>
                <span id='icon2' class="icon2" onclick="hidebar()">
                    <i class='bx bx-x'></i>
                </span>
                <i class='book' id="book"><a href="../booking/book.php">Book now</a></i>
                <ul id="bar">
                    <li><a href="../login/login.php"><i class='bx bxs-user'></i> Login</a></li>
                    <li><a href="../reservation/my%20reservations.php"><i class='bx bxs-bed'></i> My Reservations</a></li>
                    <li><a href="../reservation/rating.php"><i class='bx bxs-star'></i> Rate us</a></li>
                    <li><a href="../contactUs/index.php"><i class='bx bxl-gmail'></i> Contact us</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!--=============== End Of Header ===============-->


    <!--=============== Body ===============-->

    <form method="post" action="index.php">
        <div class="features">
            <div class='container-fluid root'>
                <div class="row container-fluid">
                    <div class='feature' id="receptionists-table">
                        <?php
                        try {
                            echo construct_log_table();
                        } catch (Exception $e) {
                            echo "<p>" . $e->getMessage() . "</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--=============== End Of Body ===============-->


    <!--=============== Footer ===============-->
    <footer class='footer'>
        <div class='container p-4 pb-0'>
            <!-- Section: Social media -->
            <section class='github'>
                <!-- Github -->
                <a href='https://github.com/Belal-Elsabbagh/Hurgada-GRND-Hotel' role='button'>
                    <img src='../../resources/img/icons/GitHub-Mark-Light-64px.png' width='32' alt='Our GitHub'> GitHub Repository
                </a>
            </section>
        </div>
        <!-- Section: Social media -->
        <!-- Copyright -->
        <div class='copyright'>
            &copy; 2022
            <span>MIU</span> All Rights Reserved
        </div>
        <!-- Copyright -->
    </footer>
    <span class="c-scroller_thumb"></span>
    <!--=============== End Of Footer ===============-->
</body>

</html>
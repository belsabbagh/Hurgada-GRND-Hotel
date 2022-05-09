<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../global/css/style.css">
    <link rel="stylesheet" href="style.css">
    <title>Booking</title>
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- Main JS File -->
    <script src="../../global/template/template.js"></script>
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="../../global/template/normalize.css"/>
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="../../global/template/template.css"/>
    <script>
        const params = new URLSearchParams(window.location.search);
        if (params.has("err")) alert(params.get('err'));
    </script>
</head>

<body>
<!-- Header -->
<div class="header" id="header">
    <div class="container">
        <div class="links">
                <span id="icon" class="icon" onclick="showbar()">
                    <em class='bx bx-menu-alt-left'></em>
                </span>
            <div class="items" id="items">
                    <span class="container">
                        <span>Home</span>
                    </span>
                <span class="container">
                        <span>Rooms</span>
                    </span>
                <span class="container">
                        <span>Dining</span>
                    </span>
                <span class="container">
                        <span>Experience</span>
                    </span>
                <span class="container">
                        <span>Location</span>
                    </span>
                <span class="container">
                        <span>About</span>
                    </span>
            </div>
            <span id='icon2' class="icon2" onclick="hidebar()">
                    <em class='bx bx-x'></em>
                </span>
            <em class='book' id="book">Book now</em>
            <ul id="bar">
                <li><a href="http://localhost/Hurgada-GRND-Hotel/pages/profile"><em class='bx bxs-user'></em>Profile</a>
                </li>
                <li><a href="http://localhost/Hurgada-GRND-Hotel/pages/reservation"><em class='bx bxs-bed'></em> My
                        Reservations</a></li>
                <li><a href="http://localhost/Hurgada-GRND-Hotel/pages/rate-us"><em class='bx bxs-star'></em> Rate
                        us</a></li>
                <li><a href="http://localhost/Hurgada-GRND-Hotel/pages/contact-us"><em class='bx bxl-gmail'></em>Contact
                        us</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- End Of Header -->

<!-- Body -->
<div class="features">
    <div class="container">
        <div class="feat" style="margin: auto;">
            <?php
            include_once "view_loader.php";
            try
            {
                $data = get_receptionists();
            } catch (Exception $e)
            {
                echo "<p>" . $e->getMessage() . "</p>";
                return;
            }
            echo construct_receptionists_table($data);
            ?>
            <a class="view-button" href="http://localhost/Hurgada-GRND-Hotel/pages/receptionists/view-receptionist.php"><span>Add Receptionist</span></a>
        </div>
    </div>
</div>
<!-- End Of Body -->


<!-- Footer -->
<div class="footer">
    &copy; 2022
    <span>MIU</span>
    All Rights Reserved
</div>
<!-- End Of Footer -->

<!-- Scroll Bar -->
<span class="c-scroller_thumb"></span>
</body>

</html>
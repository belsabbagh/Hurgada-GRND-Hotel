<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../global/css/style.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
        function change_max_beds() {
            const radioButtons = document.getElementsByName('room_type');
            document.getElementById('room_beds_number').max = get_max($("input[type='radio'][name='room_type']:checked").val());
            if (document.getElementById('room_beds_number').max < document.getElementById('room_beds_number').value) {
                document.getElementById('room_beds_number').value = document.getElementById('room_beds_number').max;
            }
        }
    </script>
    <script src="../functions.js">
        let today = new Date();
        let dd = today.getDate();
        let mm = today.getMonth() + 1; //January is 0 so need to add 1 to make it 1!
        let yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("checkin").setAttribute("min", today);
        document.getElementById("checkout").setAttribute("min", today);
    </script>
    <?php include "../../../global/php/db-functions.php"; ?>
    <title>Booking</title>
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- Main JS File -->
    <script src="template.js"></script>
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="../../../global/Template/normalize.css"/>
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="../../../global/Template/template.css"/>
</head>

<body>
<!-- Header -->
<div class="header" id="header">
    <div class="container">
        <div class="links">
                <span id="icon" class="icon" onclick="showbar()">
                    <i class='bx bx-menu-alt-left'></i>
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
                    <i class='bx bx-x'></i>
                </span>
            <i class='book' id="book">Book now</i>
            <ul id="bar">
                <li><a href="Profile"><i class='bx bxs-user'></i> Profile</a></li>
                <li><a href="MyReservations"><i class='bx bxs-bed'></i> My Reservations</a></li>
                <li><a href="RateUs"><i class='bx bxs-star'></i> Rate us</a></li>
                <li><a href="ContacUs"><i class='bx bxl-gmail'></i> Contact us</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- End Of Header -->

<!-- Body -->
<div class="features">
    <div class="container">
        <div class="feat">
            <form action="book.php" method="post">
                <div class="dates">
                    <label for="checkin">Check in date</label>
                    <input type="date" id="checkin" name="checkin">
                    <label for="checkout">Check out date</label>
                    <input type="date" id="checkout" name="checkout">
                </div>
                <div class="num-of-occupants">
                    <label for="adults">Number of adults</label>
                    <input type="number" id="adults" name="adults" min="1" max="4">
                    <label for="children">Number of children</label>
                    <input type="number" id="children" name="children" min="0" max="8">
                </div>
                <div class="options">
                    <div class="room_type">
                        <?php load_room_types(); ?>
                    </div>
                    <div class="view">
                        <?php load_room_views(); ?>
                    </div>
                    <div class="outdoors">
                        <input class="options" id="outdoors_balcony" name="outdoors" type="radio" value="0">
                        <label for="outdoors_balcony">Balcony</label>
                        <input class="options" id="outdoors_patio" name="outdoors" type="radio" value="1">
                        <label for="outdoors_patio">Patio</label>
                    </div>
                    <div class="beds">
                        <input type="number" id="room_beds_number" name="room_beds_number" value="1" min="1" max="4">
                        <label for="room_beds_number">Number of beds</label>
                    </div>
                </div>
                <input type="submit" class="submit" id="submit" name="submit">
            </form>
            <button id="clear_filters" onclick="clear_filters()">Clear all options</button>
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
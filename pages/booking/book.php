<?php
include_once "../../global/php/db-functions.php";
const FORM_URL = "Location: http://localhost/Hurgada-GRND-Hotel/pages/booking/form.php";

/**
 * Runs booking from form.php
 *
 * @author  @Belal-Elsabbagh
 *
 * @throws Exception
 *
 * @var     ReservationRequest $reservation_request Requested reservation parameters
 * @var     RoomOptions        $options             Requested room options
 * @var     int                $nBeds               number of beds needed
 * @var     float              $price               Calculated price of room
 * @return  void
 */
function book(): void
{
    $client_id = array_key_exists('email', $_POST) ? get_user_id_from_email($_POST['email']) : $_SESSION['active_id'];
// Gather data from POST and parse into correct data type
    $reservation_request = new ReservationRequest
    (
        new DateTime($_POST['checkin']), new DateTime($_POST['checkout']),
        intval($_POST['adults']), intval($_POST['children']),
        new RoomOptions
        (
            array_key_exists('room_type', $_POST) ? intval($_POST['room_type']) : 'room_type_id',
            array_key_exists('room_view', $_POST) ? intval($_POST['room_view']) : 'room_view',
            array_key_exists('outdoors', $_POST) ? intval($_POST['outdoors']) : 'room_patio'
        )
    );

    if ($reservation_request->bad_date())
    {
        header(FORM_URL);
        die("Invalid Dates");
    }
    $room = $reservation_request->get_available_room();
    if (!$room)
    {
        header(FORM_URL);
        die("No room was found matching these options");
    }
    if (room_overflow($room['room_id'], $reservation_request))
    {
        header(FORM_URL);
        die("Too many people in one room");
    }
    $price = $reservation_request->calculate_reservation_price($room['room_base_price']);
    $reservation_request->add_reservation($client_id, $room['room_id'], $price);
    $reservation_request->log($client_id, $room['room_id'], $price);
    /*TODO Redirect to account page*/
}

?>

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
                <li><a href="http://localhost/Hurgada-GRND-Hotel/pages/profile"><em class='bx bxs-user'></em>
                        Profile</a>
                </li>
                <li><a href="http://localhost/Hurgada-GRND-Hotel/pages/reservation"><em class='bx bxs-bed'></em> My
                        Reservations</a></li>
                <li><a href="http://localhost/Hurgada-GRND-Hotel/pages/rate-us"><em class='bx bxs-star'></em> Rate
                        us</a>
                </li>
                <li><a href="http://localhost/Hurgada-GRND-Hotel/pages/contact-us"><em class='bx bxl-gmail'></em>
                        Contact
                        us</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- End Of Header -->

<!-- Body -->
<div class="features">
    <div class="container">
        <div class="feat">
            <p><?php
                if (!isset($_POST['submit'])) die("Form was not submitted correctly");
                try
                {
                    book();
                } catch (Exception $e)
                {
                    echo $e->getMessage();
                }
                ?></p>
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
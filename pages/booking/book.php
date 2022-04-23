<?php
include_once "../../../global/php/db-functions.php";

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
        new DateTime($_POST['checkin']),
        new DateTime($_POST['checkout']),
        intval($_POST['adults']),
        intval($_POST['children']),
        intval($_POST['room_beds_number']),
        new RoomOptions
        (
            array_key_exists('room_type', $_POST) ? intval($_POST['room_type']) : 'room_type_id',
            array_key_exists('room_view', $_POST) ? intval($_POST['room_view']) : 'room_view',
            array_key_exists('outdoors', $_POST) ? intval($_POST['outdoors']) : 'room_patio'
        )
    );

// Check Constraints
    if ($reservation_request->bad_date())
    {
        header("Location: http://localhost/Hurgada-GRND-Hotel/pages/booking/client/form.php");
        die("Invalid Dates");
    }

    $room = $reservation_request->get_available_room();
    if ($room == null)
    {
        header("Location: http://localhost/Hurgada-GRND-Hotel/pages/booking/client/form.php");
        die("No room was found matching these options");
    }
    $price = $reservation_request->calculate_reservation_price(floatval($room['room_base_price']));
    $reservation_request->add_reservation($client_id, $room['room_id'], $price);

    activity_log("Room ReservationRequest", "Client $client_id reserved room number {$room['room_id']} from {$reservation_request->getStart()->format('Y-m-d')} to {$reservation_request->getEnd()->format('Y-m-d')} for {$reservation_request->getNAdults()} adults and {$reservation_request->getNChildren()} children.", $price);
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
                <li><a href="ContactUs"><i class='bx bxl-gmail'></i> Contact us</a></li>
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
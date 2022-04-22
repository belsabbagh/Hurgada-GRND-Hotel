<?php
include_once "../../../global/php/db-functions.php";

/**
 * Runs booking from form.php
 *
 * @author  @Belal-Elsabbagh
 *
 * @throws Exception
 *
 * @var     DateTime $checkin_date  start date of reservation
 * @var     DateTime $checkout_date end date of reservation
 * @var     int      $nAdults       number of adults in reservation
 * @var     int      $nChildren     number of children in reservation
 * @var     int      $room_type     requested room type
 * @var     int      $room_view     requested room view
 * @var     int      $patio         balcony (0) or patio (1)
 * @var     int      $nBeds         number of beds needed
 * @return  void
 */
function book(): void
{
// Gather data from POST and parse into correct data type
    $reservation_request = new Reservation(new DateTime($_POST['checkin']), new DateTime($_POST['checkout']), intval($_POST['adults']), intval($_POST['children']));
    $options = new RoomOptions(intval($_POST['room_type']), intval($_POST['room_view']), intval($_POST['outdoors']));
    $nBeds = intval($_POST['room_beds_number']);

// Check Constraints
    if ($reservation_request->bad_date()) die("Invalid dates");

    $room = get_available_rooms($reservation_request, $nBeds, $options);
    $price = get_room_price((float)$room['room_base_price'], $reservation_request);
    add_reservation($_SESSION['active_id'], $room['room_id'], $reservation_request, $price);

    activity_log("Room Reservation", "Client {$_SESSION['active_id']} reserved room number {$room['room_id']} from {$reservation_request->getStart()->format('Y-m-d')} to {$reservation_request->getEnd()->format('Y-m-d')} for {$reservation_request->getNAdults()} adults and {$reservation_request->getNChildren()} children.", $price);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../global/css/style.css">
    <link rel="stylesheet" href="../style.css">
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
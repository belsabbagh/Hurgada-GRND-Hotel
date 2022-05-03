<?php
include_once "../../global/php/db-functions.php";
const FORM_URL = "http://localhost/Hurgada-GRND-Hotel/pages/booking/form.php";

/**
 * Runs booking from form.php
 *
 * @author  @Belal-Elsabbagh
 *
 * @throws Exception Emits Exception in case of an error.
 * @var int|null $client_id The client's id in the database.
 *
 * @return  void
 */
function book(): void
{
    if (!isset($_POST['submit'])) throw new Exception("Form was not submitted correctly", 1);
    $client_id = array_key_exists('email', $_POST) ? get_user_id_from_email($_POST['email']) : ($_SESSION['active_id'] ?? null);
    if (is_null($client_id)) throw new Exception("No valid login or client.", 2);

    // Gather data from POST and parse into correct data type
    try
    {
        $start_date = new DateTime($_POST['checkin']);
        $end_date = new DateTime($_POST['checkout']);
    } catch (Exception $e)
    {
        throw new Exception("Failed to process dates", 3, $e);
    }

    $reservation_request = new ReservationRequest(
        $start_date,
        $end_date,
        intval($_POST['adults']),
        intval($_POST['children']),
        new RoomOptions(
            array_key_exists('room_type', $_POST) ? intval($_POST['room_type']) : 'room_type_id',
            array_key_exists('room_view', $_POST) ? intval($_POST['room_view']) : 'room_view',
            array_key_exists('outdoors', $_POST) ? intval($_POST['outdoors']) : 'room_patio'
        )
    );

    if ($reservation_request->bad_date()) throw new Exception("Invalid Date Chosen.", 4);

    $room = $reservation_request->get_available_room();
    if (!$room) throw new Exception("No Room matches these options.");
    if (room_overflow($room['room_id'], $reservation_request)) throw new Exception("Too many people in one room.", 5);

    $price = $reservation_request->calculate_reservation_price($room['room_base_price']);
    $reservation_request->add_reservation($client_id, $room['room_id'], $price);
    $reservation_request->log($client_id, $room['room_id'], $price);
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
                try
                {
                    book();
                    echo "Booking successful.";
                } catch (Exception $e)
                {
                    echo "<img src='../../resources/img/icons/warning-sign.png' alt='warning sign' width='150' height='150'><br> {$e->getMessage()}" . "<br>";
                    if ($e->getCode() == 2) echo "<a href='" . FORM_URL . "'>Log in</a>";

                } finally
                {
                    echo "<a href='" . FORM_URL . "'>Go back to form</a>";
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
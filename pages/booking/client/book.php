<?php
include_once "../../../global/php/db-functions.php";

/**
 * Gets the difference between two dates in days
 *
 * @param DateTime $from_date The starting date
 * @param DateTime $to_date The ending date
 *
 * @return  int  The difference in days
 * @author @Belal-Elsabbagh
 *
 */
function get_numberof_days_between_dates(DateTime $from_date, DateTime $to_date): int
{
    return (int)round((strtotime($to_date->format('Y-m-d')) - strtotime($from_date->format('Y-m-d'))) / (60 * 60 * 24));
}

/**
 * Runs booking from form.php
 *
 * @return  void
 * @throws Exception
 *
 * @var     DateTime $checkin_date
 * @var     DateTime $checkout_date
 * @var     int $nAdults
 * @var     int $nChildren
 * @var     int $room_type
 * @var     int $room_view
 * @var     int $patio
 * @var     int $nBeds
 * @author  @Belal-Elsabbagh
 *
 */
function book(): void
{
// Gather data from POST
    $checkin_date = new DateTime($_POST['checkin']);
    $checkout_date = new DateTime($_POST['checkout']);
    $nAdults = intval($_POST['adults']);
    $nChildren = intval($_POST['children']);
    $room_type = intval($_POST['room_type']);
    $room_view = intval($_POST['room_view']);
    $patio = intval($_POST['outdoors']);
    $nBeds = intval($_POST['room_beds_number']);

// Check Constraints
    if (bad_date($checkin_date, $checkout_date)) die("Invalid dates");

    $date_format = "Y-m-d";
    $get_rooms = "SELECT room_id FROM rooms 
        where room_id NOT IN 
        (
            SELECT room_no FROM reservations 
            WHERE (start_date BETWEEN '{$checkin_date->format($date_format)}' AND '{$checkout_date->format($date_format)}') 
            OR (end_date BETWEEN '{$checkin_date->format($date_format)}' AND '{$checkout_date->format($date_format)}') 
            OR (start_date >= '{$checkin_date->format($date_format)}' AND end_date <= '{$checkout_date->format($date_format)}')
        )
        AND room_beds_number = $nBeds
        AND room_type_id = $room_type 
        AND room_view = $room_view
        AND room_patio = $patio;";

// Check if a room with these options exist
    $result_rooms = run_query($get_rooms);
    if (mysqli_num_rows($result_rooms) == 0) die("No room matches these options");
    $room = mysqli_fetch_assoc($result_rooms);
    echo "Room found";
    $price = get_numberof_days_between_dates($checkin_date, $checkout_date) * (float)$room['room_base_price'];

    $book_query = "INSERT into reservations
    values(
        NULL, 
        {$_SESSION['active_id']},
        {$room['room_id']},
        '{$checkin_date->format($date_format)}', 
        '{$checkout_date->format($date_format)}', 
        $nAdults, 
        $nChildren, 
        $price,
       0);";

    run_query($book_query);
    activity_log("Room Reservation", "Client {$_SESSION['active_id']} reserved room number {$room['room_id']} from {$checkin_date->format($date_format)} to {$checkout_date->format($date_format)} for $nAdults adults and $nChildren children.", $price);
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
<?php
if (!isset($_SESSION)) session_start();

include_once "../../global/php/db-functions.php";
include_once "form_loader.php";
const FORM_URL = "http://localhost/Hurgada-GRND-Hotel/pages/booking/index.php";
const LOGIN_ERRNO = 313;
/**
 * Runs booking from form.php
 *
 * @author  Belal-Elsabbagh
 *
 * @throws Exception Emits Exception in case of an error.
 * @var int|null $client_id The client's id in the database.
 *
 * @return  void
 */
function run_booking_procedure(): void
{
    if (!post_data_exists()) throw new RuntimeException("Form was not submitted correctly", 1);
    $client_id = array_key_exists('email', $_POST) ? get_user_id_from_email($_POST['email']) : get_active_user_id();
    if (is_null($client_id)) throw new Exception("No valid login or client.", LOGIN_ERRNO);

    // Gather data from POST and parse into correct data type
    try {
        $start_date = new DateTime($_POST['checkin']);
        $end_date = new DateTime($_POST['checkout']);
    } catch (Exception $e) {
        throw new ValueError("Failed to process dates", 3, $e);
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
    //print_r($reservation_request);
    if ($reservation_request->bad_date()) throw new LogicException("Invalid Date Chosen.", 4);

    $room = $reservation_request->get_available_room();
    if (is_null($room)) throw new LogicException("No Room matches these options.");
    if (room_overflow($room['room_id'], $reservation_request->getNAdults(), $reservation_request->getNChildren())) throw new LogicException("Too many people in one room.", 5);
    $price = $reservation_request->calculate_reservation_price($room['room_base_price']);
    try {
        $reservation_request->add_reservation($client_id, $room['room_id'], $price);
    } catch (Exception $e) {
        throw new RuntimeException("Failed to create reservation.", 666, $e);
    }
    $reservation_request->log($client_id, $room['room_id'], $price);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>HURGADA-GRND-HOTEL</title>
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='../../global/css/bootstrap-5.0.2-dist/css/bootstrap.css'>
    <script src='../../global/css/bootstrap-5.0.2-dist/js/bootstrap.js'></script>
    <script src='../../global/js/font-awesome.js'></script>
    <link rel='stylesheet' href='../../global/css/style.css' />
    <link rel='stylesheet' href='./style.css' />
    <!-- Main template CSS File -->
    <link rel='stylesheet' href='../../global/template/template.css' />
    <!-- Main JS File -->
    <script src='../../global/template/template.js'></script>
</head>

<body>
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
                <i class='book' id="book"><a href="../booking/index.php">Book now</a></i>
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
            <div class='container root'>
                <div class="content">
                    <div class='feature'>
                        <?php
                        $content = "Operation Successful.";
                        try {
                            run_booking_procedure();
                        } catch (Exception $e) {
                            $content = "<img src='../../resources/img/icons/warning-sign.png' alt='warning sign' width='150' height='150'><br> {$e->getMessage()}" . "<br>";
                            if ($e->getCode() == LOGIN_ERRNO) $content .= "<a href='" . FORM_URL . "'>Log in</a>";
                        } finally {
                            $content .= "<a href='" . FORM_URL . "'>Go back to form</a>";
                        }
                        echo $content;
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
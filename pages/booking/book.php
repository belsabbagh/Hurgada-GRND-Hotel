<?php
include_once "../../global/php/db-functions.php";
const FORM_URL = "http://localhost/Hurgada-GRND-Hotel/pages/booking/form.php";
const LOGIN_ERRNO = 313;
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
    if (!post_data_exists()) throw new RuntimeException("Form was not submitted correctly", 1);
    $client_id = array_key_exists('email', $_POST) ? get_user_id_from_email($_POST['email']) : ($_SESSION['active_id'] ?? null);
    if (is_null($client_id)) throw new Exception("No valid login or client.", LOGIN_ERRNO);

    // Gather data from POST and parse into correct data type
    try
    {
        $start_date = new DateTime($_POST['checkin']);
        $end_date = new DateTime($_POST['checkout']);
    } catch (Exception $e)
    {
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

    if ($reservation_request->bad_date()) throw new LogicException("Invalid Date Chosen.", 4);

    $room = $reservation_request->get_available_room();
    if (!$room) throw new LogicException("No Room matches these options.");
    if (room_overflow($room['room_id'], $reservation_request)) throw new LogicException("Too many people in one room.", 5);
    $price = $reservation_request->calculate_reservation_price($room['room_base_price']);
    try
    {
        $reservation_request->add_reservation($client_id, $room['room_id'], $price);
    } catch (Exception $e)
    {
        throw new RuntimeException("Failed to create reservation.", 666, $e);
    }
    $reservation_request->log($client_id, $room['room_id'], $price);
}
?>
<?php
include_once "../../global/php/db-functions.php";
include_once "form_loader.php";
?>
<!DOCTYPE html>
<html lang='en'>

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
    <link rel='stylesheet' href='../../global/css/style.css'/>
    <link rel='stylesheet' href='style.css' />
    <!-- Main template CSS File -->
    <link rel='stylesheet' href='../../global/template/template-bootstrap.css' />
    <!-- Main JS File -->
    <script src='../../global/template/template.js'></script>
</head>

<body class='d-flex flex-column min-vh-100'>
    <!-- Header -->
    <nav class='navbar' id='header'>
        <div class='container-fluid'>
            <div class='navbar-header' onclick='showbar()'>
                <span class='navbar-brand'><em class='bx bx-menu-alt-left icon'></em></span>
            </div>
            <div class='row'>
                <ul class='nav items' id='items'>
                    <li class='nav-item'><span class='nav navbar-nav nav-link-container'><a class='nav-link nlink' href='#'>Home</a></span></li>
                    <li class='nav-item'><span class='nav navbar-nav nav-link-container'><a class='nav-link nlink' href='#'>Rooms</a></span></li>
                    <li class='nav-item'><span class='nav navbar-nav nav-link-container'><a class='nav-link nlink' href='#'>Dining</a></span></li>
                    <li class='nav-item'><span class='nav navbar-nav nav-link-container'><a class='nav-link nlink' href='#'>Experience</a></span></li>
                    <li class='nav-item'><span class='nav navbar-nav nav-link-container'><a class='nav-link nlink' href='#'>Location</a></span></li>
                    <li class='nav-item'><span class='nav navbar-nav nav-link-container'><a class='nav-link nlink' href='#'>About</a></span></li>
                </ul>
            </div>
            <div>
                <span id='icon2' class='icon2' onclick='hidebar()'><em class='bx bx-x'></em></span>
            </div>
            <span class='book nav navbar-nav navbar-right nav-link-container text-center' id='book'><a class='nav-link nlink' href='#'>Book now</a></span>
        </div>
    </nav>
    <!-- End Of Header -->

    <!-- Body -->


    <div class='container root'>
        <div class='feature'>
        <?php
        $content = "Operation Successful.";
        try
        {
            book();
        } catch (Exception $e)
        {
            $content = "<img src='../../resources/img/icons/warning-sign.png' alt='warning sign' width='150' height='150'><br> {$e->getMessage()}" . "<br>";
            if ($e->getCode() == LOGIN_ERRNO) $content .= "<a href='" . FORM_URL . "'>Log in</a>";

        } finally
        {
            $content .= "<a href='" . FORM_URL . "'>Go back to form</a>";
        }
        ?>
        </div>
    </div>
    <!-- End Of Body -->


    <!-- Footer -->
    <footer class='text-center text-white mt-auto' style='background-color: var(--blue0-color);'>
        <!-- Grid container -->
        <div class='container p-4 pb-0'>
            <!-- Section: Social media -->
            <section class='mb-4'>
                <!-- Github -->
                <a class='btn btn-outline-light btn-floating m-1' href='https://github.com/Belal-Elsabbagh/Hurgada-GRND-Hotel' role='button'>
                    <img src='../../resources/img/icons/GitHub-Mark-Light-64px.png' width='32' alt='Our GitHub'> GitHub Repository
                </a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class='text-center p-3' style='background-color: var(--blue0-color);'>
            &copy; 2022
            <span>MIU</span> All Rights Reserved
        </div>
        <!-- Copyright -->
    </footer>
    <!-- End Of Footer -->

    <!-- Scroll Bar -->
    <span class='c-scroller_thumb'></span>
</body>

</html>

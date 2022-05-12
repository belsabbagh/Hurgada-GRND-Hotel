<?php
include_once "classes/RoomOptions.php";
include_once "classes/ReservationRequest.php";

const REPOSITORY_PAGES_URL = "http://localhost/Hurgada-GRND-Hotel/pages/";

/**
 * Creates connection to database
 *
 * @author  @Belal-Elsabbagh
 *
 * @throws RuntimeException Emits exception in case of connection error.
 * @return  mysqli  Connection object to the database
 */
function db_connect(): mysqli
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hurgada-grnd-hotel";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_errno)
    {
        throw new RuntimeException('mysqli connection error: ' . $conn->connect_error, $conn->connect_errno);
    }
    return $conn;
}

/**
 * Connects database, runs the given query, and returns the result
 *
 * @author  @Belal-Elsabbagh
 *
 * @throws RuntimeException Thrown if connection was unsuccessful.
 * @throws mysqli_sql_exception Thrown if the query wasn't run successfully.
 *
 * @param string $sql The sql query to run
 *
 * @return mysqli_result|bool The result of the query
 */
function run_query(string $sql): mysqli_result|bool
{
    try
    {
        $conn = db_connect();
    } catch (RuntimeException $e)
    {
        throw new RuntimeException($e);
    }
    $result = $conn->query($sql);
    if ($result === false) throw new mysqli_sql_exception("Failed to run query.\n$conn->error", $conn->errno);
    $conn->close();
    return $result;
}

/**
 * Checks if mysqli_result is empty by checking if its null and the number of rows it returned is zero.
 *
 * @author @Belal-Elsabbagh
 *
 * @param mysqli_result|null $result
 *
 * @return bool
 */
function empty_mysqli_result(?mysqli_result $result): bool
{
    return $result && $result->num_rows == 0;
}

/**
 * Logs action in activity Log
 *
 * @author  @Belal-Elsabbagh
 *
 * @param string     $description The description of the action.
 * @param float|null $transaction Amount of money transferred.
 * @param string     $action      The action that the user made.
 *
 * @var     string   $sql
 * @return  void
 */
function activity_log(string $action, string $description, ?float $transaction = null): void
{
    $sql = "INSERT INTO activity_log
    (owner, actiontype, description, transaction) 
    VALUES({$_SESSION['active_id']}, '$action', '$description', $transaction)";
    try
    {
        run_query($sql);
    } catch (Exception $e)
    {
        echo $e->getMessage();
    }
}

/**
 * Checks availability of room within a certain time period
 *
 * @author @Belal-Elsabbagh
 *
 * @param DateTime $start_date The start date of the booking
 * @param DateTime $end_date   The end date of the booking
 * @param int      $room_id    The room to be booked
 *
 * @return bool Returns true if room is available, false if room is unavailable
 *
 */
function room_isAvailable(int $room_id, DateTime $start_date, DateTime $end_date): bool
{
    $date_format = "Y-m-d";
    $start_date_str = $start_date->format($date_format);
    $end_date_str = $end_date->format($date_format);
    $sql = "SELECT room_no FROM reservations
            WHERE ((start_date BETWEEN '$start_date_str' AND '$end_date_str') 
            OR (end_date BETWEEN '$start_date_str' AND '$end_date_str') 
            OR (start_date >= '$start_date_str' AND end_date <= '$end_date_str'))
            AND room_no = $room_id";
    try
    {
        $result = run_query($sql);
    } catch (Exception $e)
    {
        echo $e->getMessage();
        return false;
    }
    if ($result->num_rows == 0) return true;
    return false;
}

/**
 * Gets the current user's type
 *
 * @author @Belal-Elsabbagh
 *
 * @return bool True if the user is an employee, False if the user is a client
 */
function active_user_isEmployee(): bool
{
    $sql = "SELECT user_type FROM users WHERE user_id = {$_SESSION['active_id']}";
    try
    {
        $result = run_query($sql);
    } catch (Exception $e)
    {
        echo $e->getMessage();
        return false;
    }
    $user = $result->fetch_assoc();
    if ($user['user_type'] > 1) return true;
    return false;
}

/**
 * Takes an email and gets its user id
 *
 * @author @Belal-Elsabbagh
 *
 * @param             $email
 *
 * @var string        $sql  The Query String
 * @var mysqli_result $result
 * @var array         $user The user's data
 * @return int|null returns user id or null if not found
 */
function get_user_id_from_email($email): ?int
{
    $sql = "SELECT user_id FROM users WHERE email = '$email'";
    try
    {
        $result = run_query($sql);
    } catch (Exception $e)
    {
        echo $e->getMessage();
        return null;
    }
    if (empty_mysqli_result($result)) return null;
    $user = $result->fetch_assoc();
    return $user['user_id'];
}

/**
 * Gets the maximum number of occupants for a room
 *
 * @author @Belal-Elsabbagh
 *
 * @param int $room_id The room number
 *
 * @return int|null The room's maximum capacity
 */
function get_room_max_occupants_by_room_id(int $room_id): ?int
{
    $sql = "SELECT room_max_cap FROM room_types, rooms
            WHERE rooms.room_type_id = room_types.type_id 
            AND rooms.room_id = $room_id;";
    try
    {
        $result = run_query($sql);
    } catch (Exception $e)
    {
        echo $e->getMessage();
        return null;
    }
    if (empty_mysqli_result($result)) return null;
    $room = $result->fetch_assoc();
    return $room['room_max_cap'];
}

/**
 * Checks if the requested reservation exceeds maximum room capacity
 *
 * @param int                $room_id             The room number to be checked
 * @param ReservationRequest $reservation_request The given reservation request to check
 *
 * @return bool True if the requested reservation exceeds maximum room capacity. False otherwise
 */
function room_overflow(int $room_id, ReservationRequest $reservation_request): bool
{
    $room_max_cap = get_room_max_occupants_by_room_id($room_id);
    $numberof_occupants = $reservation_request->getNAdults() + round($reservation_request->getNChildren() / 2);
    if ($numberof_occupants > $room_max_cap) return true;
    return false;
}

/**
 * Gets all the receptionists in the database
 *
 * @author @Belal-Elsabbagh
 *
 * @throws Exception If the function was not able to get the receptionists
 * @return mysqli_result
 */
function get_receptionists(): mysqli_result
{
    $sql = "SELECT user_id, email, first_name, last_name, national_id_photo, user_pic, receptionist_enabled, receptionist_qc_comment FROM users WHERE user_type = 2";
    try
    {
        $result = run_query($sql);
    } catch (Exception $e)
    {
        throw new LogicException("Unable to get receptionists", 333, $e);
    }
    return $result;
}

/**
 * Gets user from database by their id
 *
 * @author @Belal-Elsabbagh
 *
 * @param int $id The user id.
 *
 * @return array|null Returns an associative array of the found user. Returns null otherwise.
 */
function get_user_by_id(int $id): ?array
{
    try
    {
        $result = run_query("SELECT * FROM users WHERE user_id = $id;");
    } catch (Exception)
    {
        return null;
    }
    if (empty_mysqli_result($result)) return null;
    return $result->fetch_assoc();
}

/**
 * Constructs header bars respective to the active user type.
 *
 * @author @Belal-Elsabbagh
 * @var Closure $generate_item A function that creates an item in the header bar.
 * @return string The html structure of the items.
 */
function load_header_bar(): string
{
    /**
     * Generates header bar item with a specific title and link.
     *
     * @param string $title The title of the item.
     * @param string $link  The link that the item takes the user to.
     *
     * @return string The html content of the item.
     */
    $generate_item = function (string $title, string $link): string
    {
        return "<span class='container'><a class='header-link' href='$link'>$title</a></span>";
    };
    $home = $generate_item("Home", REPOSITORY_PAGES_URL . "home");
    $profile = $generate_item("Profile", REPOSITORY_PAGES_URL . "profile");
    $reservations = $generate_item("Reservations", REPOSITORY_PAGES_URL . "reservations");
    $my_reservations = $generate_item("My Reservations", REPOSITORY_PAGES_URL . "reservations");
    $rooms = $generate_item("Rooms", REPOSITORY_PAGES_URL . "rooms");
    $ratings = $generate_item("Ratings", REPOSITORY_PAGES_URL . "ratings");

    return match ($_SESSION['active_user_type'])
    {
        3 => $home . $profile . $my_reservations . '<span class="container"><a class="header-link" href="">About</a></span>',
        2 => $home . $profile . $reservations . $rooms,
        1 => $home . $profile . $reservations . $rooms . $ratings,
        default => $home . '
        <span class="container"><a class="header-link" href="">Rooms</a></span>
        <span class="container"><a class="header-link" href="">Dining</a></span>
        <span class="container"><a class="header-link" href="">Experience</a></span>
        <span class="container"><a class="header-link" href="">Location</a></span>
        <span class="container"><a class="header-link" href="">About</a></span>'
    };
}

/**
 * Constructs the page template with the custom html content given to it.
 *
 * @author @Belal-Elsabbagh
 *
 * @param string $html_content The html data to be presented within the template
 *
 * @return string The complete html page.
 */
function construct_template(string $html_content): string
{
    return "<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='../../global/css/style.css'>
    <link rel='stylesheet' href='style.css'>
    <title>Booking</title>
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- Main JS File -->
    <script src='../../global/template/template.js'></script>
    <!-- Render All Elements Normally -->
    <link rel='stylesheet' href='../../global/template/normalize.css'/>
    <!-- Main Template CSS File -->
    <link rel='stylesheet' href='../../global/template/template.css'/>
    <script>
        const params = new URLSearchParams(window.location.search);
        if (params.has('err')) alert(params.get('err'));
    </script>
</head>

<body>
<!-- Header -->
<div class='header' id='header'>
    <div class='container'>
        <div class='links'>
                <span id='icon' class='icon' onclick='showbar()'>
                    <em class='bx bx-menu-alt-left'></em>
                </span>
            <div class='items' id='items'>
                    <span class='container'>
                        <span>Home</span>
                    </span>
                <span class='container'>
                        <span>Rooms</span>
                    </span>
                <span class='container'>
                        <span>Dining</span>
                    </span>
                <span class='container'>
                        <span>Experience</span>
                    </span>
                <span class='container'>
                        <span>Location</span>
                    </span>
                <span class='container'>
                        <span>About</span>
                    </span>
            </div>
            <span id='icon2' class='icon2' onclick='hidebar()'>
                    <em class='bx bx-x'></em>
                </span>
            <em class='book' id='book'>Book now</em>
            <ul id='bar'>
                <li><a href='http://localhost/Hurgada-GRND-Hotel/pages/profile'><em class='bx bxs-user'></em>Profile</a>
                </li>
                <li><a href='http://localhost/Hurgada-GRND-Hotel/pages/reservation'><em class='bx bxs-bed'></em> My
                        Reservations</a></li>
                <li><a href='http://localhost/Hurgada-GRND-Hotel/pages/rate-us'><em class='bx bxs-star'></em> Rate
                        us</a></li>
                <li><a href='http://localhost/Hurgada-GRND-Hotel/pages/contact-us'><em class='bx bxl-gmail'></em>Contact
                        us</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- End Of Header -->

<!-- Body -->
<div class='features'>
    <div class='container'>
        <div class='feat' style='margin: auto;'>
            $html_content
        </div>
    </div>
</div>
<!-- End Of Body -->


<!-- Footer -->
<div class='footer'>
    &copy; 2022
    <span>MIU</span>
    All Rights Reserved
</div>
<!-- End Of Footer -->

<!-- Scroll Bar -->
<span class='c-scroller_thumb'></span>
</body>

</html>";
}
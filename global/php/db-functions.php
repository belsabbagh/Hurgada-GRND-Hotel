<?php
include_once "classes/RoomOptions.php";
include_once "classes/ReservationRequest.php";

const repository_pages_url = "http://localhost/Hurgada-GRND-Hotel/pages/";
/**
 * Creates connection to database
 *
 * @author  @Belal-Elsabbagh
 * @return  mysqli  Connection object to the database
 */
function db_connect(): mysqli
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hurgada-grnd-hotel";

    $conn = new mysqli($servername, $username, $password, $dbname) or throw new mysqli_sql_exception($conn->connect_error, $conn->connect_errno);
    return $conn;
}

/**
 * Connects database, runs the given query, and returns the result
 *
 * @author  @Belal-Elsabbagh
 *
 * @throws mysqli_sql_exception Emits exception if failed to connect or the query wasn't run successfully.
 *
 * @param string               $sql    The sql query to run
 *
 * @var     mysqli_result|bool $result The result of the query
 *
 * @var     mysqli             $conn   The connection object to database
 * @return  mysqli_result The result of the query
 *
 */
function run_query(string $sql): mysqli_result
{
    try
    {
        $conn = db_connect();
    } catch (mysqli_sql_exception $e)
    {
        throw new mysqli_sql_exception($e);
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
    $sql = "SELECT room_no FROM reservations
            WHERE ((start_date BETWEEN '{$start_date->format('Y-m-d')}' AND '{$end_date->format('Y-m-d')}') 
            OR (end_date BETWEEN '{$start_date->format('Y-m-d')}' AND '{$end_date->format('Y-m-d')}') 
            OR (start_date >= '{$start_date->format('Y-m-d')}' AND end_date <= '{$end_date->format('Y-m-d')}'))
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
    $home = $generate_item("Home", repository_pages_url . "home");
    $profile = $generate_item("Profile", repository_pages_url . "profile");
    $reservations = $generate_item("Reservations", repository_pages_url . "reservations");
    $my_reservations = $generate_item("My Reservations", repository_pages_url . "reservations");
    $rooms = $generate_item("Rooms", repository_pages_url . "rooms");
    $ratings = $generate_item("Ratings", repository_pages_url . "ratings");

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
    <span class="container"><a class="header-link" href="">About</a></span>',
    };
}
<?php
include_once "RoomOptions.php";
include_once "ReservationRequest.php";
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

    return new mysqli($servername, $username, $password, $dbname);
}

/**
 * Connects database, runs the given query, and returns the result
 *
 * @author  @Belal-Elsabbagh
 *
 * @param string               $sql    The sql query to run
 *
 * @var     mysqli             $conn   The connection object to database
 * @var     mysqli_result|bool $result The result of the query
 *
 * @return  mysqli_result|bool The result of the query
 *
 */
function run_query(string $sql): bool|mysqli_result
{
    $conn = db_connect();
    $result = $conn->query($sql) or die("\nFAIL\n" . $conn->error);
    $conn->close();
    return $result;
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
    run_query($sql);
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
    $result = run_query($sql);
    if ($result && $result->num_rows == 0) return true;
    return false;
}

/**
 * Gets the current user's type
 *
 * @author @Belal-Elsabbagh
 * @return bool True if the user is an employee, False if the user is a client
 */
function active_user_isEmployee(): bool
{
    $sql = "SELECT user_type FROM users WHERE user_id = {$_SESSION['active_id']}";
    $result = run_query($sql);
    $user = $result->fetch_assoc();
    if ($user['user_type'] > 1) return true;
    return false;
}

/**
 * Takes an email and gets its user id
 *
 * @author @Belal-Elsabbagh
 *
 * @param $email
 *
 * @return int|null returns user id or null if not found
 */
function get_user_id_from_email($email): ?int
{
    $sql = "SELECT user_id FROM users WHERE email = '$email'";
    $result = run_query($sql);
    if ($result && $result->num_rows == 0) return null;
    $user = $result->fetch_assoc();
    return $user['user_id'];
}

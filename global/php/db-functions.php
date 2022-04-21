<?php

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
 * @param string $sql The sql query to run
 *
 * @return  bool|mysqli_result   The result of the query
 *
 * @var     mysqli_result|bool $result The result of the query
 *
 * @var     mysqli $conn The connection object to database
 * @author  @Belal-Elsabbagh
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
 * @param string $action The action that the user made.
 * @param string $description The description of the action.
 * @param float|null $transaction Amount of money transferred.
 * @return  void
 * @var     string $sql
 * @author  @Belal-Elsabbagh
 *
 */
function activity_log(string $action, string $description, ?float $transaction): void
{
    $sql = "INSERT into activity_log
    (owner, actiontype, description, transaction) 
    values({$_SESSION['active_id']},'string$action', 'stringstring$description', $transaction)";
    run_query($sql);
}

 /**
  * Loads the room types from database and echoes them in html
  *
  * @author  @Belal-Elsabbagh
  *
  * @var     string $sql The query to get room types
  * @var     mysqli_result $result The room types
  * @var     string[] $row Each room type
  * @return  void
  */
function load_room_types(): void
{
    $sql = "select * from room_types";
    $result = run_query($sql);
    while ($row = mysqli_fetch_assoc($result))
        echo "<input class='options' type='radio' name='room_type' id='{$row['room_category']}' value='{$row['type_id']}' onchange='change_max_beds()'><label for='{$row['room_category']}'>{$row['room_category']}</label>\n";
}

/**
 * Loads the room views from database and echoes them in html
 *
 * @author  @Belal-Elsabbagh
 *
 * @var     string $sql The query to get room views
 * @var     mysqli_result $result The room views
 * @var     string[] $row Each room view
 * @return  void
 */
function load_room_views(): void
{
    $sql = "select * from room_views";
    $result = run_query($sql);
    while ($row = mysqli_fetch_assoc($result))
        echo "<input class='options' type='radio' name='room_view' id='{$row['room_view_title']}' value='{$row['room_view_id']}'><label for='{$row['room_view_title']}'>{$row['room_view_title']}</label>\n";
}

/**
 * Checks availability of room within a certain time period
 *
 * @param int $room_id The room to be booked
 * @param DateTime $start_date The start date of the booking
 * @param DateTime $end_date The end date of the booking
 * @return bool Returns true if room is available, false if room is unavailable
 *
 * @author @Belal-Elsabbagh
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
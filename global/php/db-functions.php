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
 * @return  mysqli_result   The result of the query
 *
 * @var     mysqli_result $result The result of the query
 *
 * @var     mysqli $conn The connection object to database
 * @author  @Belal-Elsabbagh
 */
function run_query(string $sql): mysqli_result
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
function activity_log(string $action, string $description, ?float $transaction)
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
function load_room_types()
{
    $sql = "select * from room_types";
    $result = run_query($sql);
    while ($row = mysqli_fetch_assoc($result))
        echo "<input type='radio' name='room_type' id='{$row['room_category']}' value='{$row['type_id']}' onchange='change_max_beds()'><label for='{$row['room_category']}'>{$row['room_category']}</label>\n";
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
function load_room_views()
{
    $sql = "select * from room_views";
    $result = run_query($sql);
    while ($row = mysqli_fetch_assoc($result))
        echo "<input type='radio' name='room_view' id='{$row['room_view_title']}' value='{$row['room_view_id']}'><label for='{$row['room_view_title']}'>{$row['room_view_title']}</label>\n";
}
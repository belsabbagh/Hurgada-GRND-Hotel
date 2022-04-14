<?php

/**
 * Creates connection to database
 * 
 * @author  @Belal-Elsabbagh
 * @return  mysqli  Connection object to the database
 */
function db_connect()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hurgada-grnd-hotel";
    return new mysqli($servername, $username, $password, $dbname);
}

/**
 * Logs action in activity Log
 * 
 * @author  @Belal-Elsabbagh
 * @param   $action         .The action that the user made.
 * @param   $description    .The description of the action.
 * @param   $transaction    .Amount of money transferred.
 * @return  void
 */
function activity_log($action, $description,?float $transaction)
{
    $conn = db_connect();
    $sql = "INSERT into activity_log
    (owner, actiontype, description, transaction) 
    values(/*TODO user id*/,'$action', '$description', $transaction)";
    $conn->query($sql) or die("Query Failed");
    $conn->close();
}

/**
 * Logs action in activity Log
 * 
 * @author  @Belal-Elsabbagh
 * @param   $action         .The action that the user made.
 * @param   $description    .The description of the action.
 * @param   $transaction    .Amount of money transferred.
 * @return  void
 */

 /**
 * Loads the room types from database and echoes them in html
 * 
 * @author  @Belal-Elsabbagh
 * @return  void
 */
function load_room_types()
{
    $conn = db_connect();
    $sql = "select * from room_types";
    $result = $conn->query($sql);
    while ($row = mysqli_fetch_assoc($result))
        echo "<input type='radio' name='room_type' id='{$row['room_category']}' value='{$row['type_id']}' onchange='change_max_beds()'><label for='{$row['room_category']}'>{$row['room_category']}</label>\n";
    $conn->close();
}

/**
 * Loads the room views from database and echoes them in html
 * 
 * @author  @Belal-Elsabbagh
 * @return  void
 */
function load_room_views()
{
    $conn = db_connect();
    $sql = "select * from room_views";
    $result = $conn->query($sql);
    while ($row = mysqli_fetch_assoc($result))
        echo "<input type='radio' name='room_view' id='{$row['room_view_title']}' value='{$row['room_view_id']}'><label for='{$row['room_view_title']}'>{$row['room_view_title']}</label>\n";
    $conn->close();
}
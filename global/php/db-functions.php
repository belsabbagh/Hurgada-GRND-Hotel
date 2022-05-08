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
 * Connects to hotel database, runs the given query, and returns the result
 *
 * @param   string $sql The sql query to run
 * @return  mysqli_result|bool
 * @author  @Belal-Elsabbagh
 *
 */
function run_query(string $sql): mysqli_result
{
    $conn = db_connect();
    $result = $conn->query($sql) or die($conn->error);
    $conn->close();
    return $result;
}

/**
 * Logs action in activity Log
 * 
 * @author  @Belal-Elsabbagh
 * 
 * @param   string      $action         The action that the user made.
 * @param   string      $description    The description of the action.
 * @param   float|null  $transaction    Amount of money transferred.
 * @return  void
 */
function activity_log(string $action, string $description, ?float $transaction)
{
    $sql = "INSERT into activity_log
    (owner, actiontype, description, transaction) 
    values(/*TODO user id*/,'string$action', 'stringstring$description', $transaction)";
    run_query($sql);
}

 /**
 * Loads the room types from database and echoes them in html
 * 
 * @author  @Belal-Elsabbagh
 * 
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
 * @return  void
 */
function load_room_views()
{
    $sql = "select * from room_views";
    $result = run_query($sql);
    while ($row = mysqli_fetch_assoc($result))
        echo "<input type='radio' name='room_view' id='{$row['room_view_title']}' value='{$row['room_view_id']}'><label for='{$row['room_view_title']}'>{$row['room_view_title']}</label>\n";
}

/**
 * Checks availability of room within a certain time period
 * 
 * @param int $room_id          The room to be booked
 * @param DateTime $start_date  The start date of the booking
 * @param DateTime $end_date    The end date of the booking
 * @return bool Returns true if room is available, false if room is unavailable
 *
 * @author @Belal-Elsabbagh
 */
function room_isAvailable(int $room_id, DateTime $start_date, DateTime $end_date): bool
{
    $sql = "SELECT room_no FROM reservations
            WHERE (( start_date BETWEEN '{$start_date->format('Y-m-d')}' AND '{$end_date->format('Y-m-d')}') 
            OR (end_date BETWEEN '{$start_date->format('Y-m-d')}' AND '{$end_date->format('Y-m-d')}') 
            OR (start_date >= '{$start_date->format('Y-m-d')}' AND end_date <= '{$end_date->format('Y-m-d')}'))
            AND room_no = $room_id";
    $result = run_query($sql);
    if($result && $result->num_rows == 0) return true;
    return false;
}
// pop msgs functions

//warning
function warningmsg ($msg ,$header,$link){

    echo"

    <div class='center' id = 'center'>
        <div class='content'>
        <div class='header'>
        <h2>$header</h2>
     </div>
        <p> $msg </p>
        <div class='line'></div>
        <form action= '' method = 'post'>
        <a href= '$link'  class = 'close-btn'> ok </a>

      
  </form>
 </div>
</div>
    ";
}


//confirm
function confirmmsg ($msg ,$header){

    echo"

    <div class='center' id = 'center'>
        <div class='content'>
        <div class='header'>
        <h2>$header</h2>
     </div>
        <p> $msg </p>
        <div class='line'></div>
        <form action= '' method = 'post'>

        <input type ='submit'  class = 'close-btn' name= 'no_btn' value = 'no'> 
        <input type ='submit'   class = 'confirm-btn' name= 'yes_btn' value = 'yes'>
  </form>
 </div>
</div>
    ";
}
?>


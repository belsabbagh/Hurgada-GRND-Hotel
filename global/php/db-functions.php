<?php
const PFP_DIRECTORY_PATH = "../../resources/img/user_pics/";
const ID_PIC_DIRECTORY_PATH = "../../resources/img/id_pics/";
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
 * @author Belal-Elsabbagh
 */
function room_isAvailable(int $room_id, DateTime $start_date, DateTime $end_date, int $reservation_id = -1): bool
{
    $start_date_str = $start_date->format('Y-m-d');
    $end_date_str = $end_date->format('Y-m-d');
    $exclude_reservation_id = ($reservation_id === -1)? "" : "AND reservation_id != $reservation_id";

    $sql = "SELECT room_no FROM reservations
            WHERE (( start_date BETWEEN '$start_date_str' AND '$end_date_str') 
            OR (end_date BETWEEN '{$start_date->format('Y-m-d')}' AND '{$end_date->format('Y-m-d')}') 
            OR (start_date >= '{$start_date->format('Y-m-d')}' AND end_date <= '{$end_date->format('Y-m-d')}'))
            AND room_no = $room_id $exclude_reservation_id";
    $result = run_query($sql);
   

    if($result->num_rows == 0) return true;
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

//confirm using link 
function confirmmsg2 ($msg ,$header,$link_no, $link_yes){

    echo"

    <div class='center' id = 'center'>
        <div class='content'>
        <div class='header'>
        <h2>$header</h2>
     </div>
        <p> $msg </p>
        <div class='line'></div>
        <form action= '' method = 'post'>
        <a href= '$link_yes'  class = 'confirm-btn'> yes </a>
        <a href= '$link_no'  class = 'close-btn'> no </a>

      
  </form>
 </div>
</div>
    ";
}
?>


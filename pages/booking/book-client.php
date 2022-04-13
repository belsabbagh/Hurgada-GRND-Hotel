<?php

/*TODO 
    Get list of rooms with specs,
    check reservations of this room if it's free on the given dates,
    book an available room, error if no room is available,
    add booking data to table with respective room number and user data,    
*/
if ($_SERVER['REQUEST_METHOD'] != 'POST') die("Form was not submitted correctly");

// Gather data from POST
$checkin_date = $_POST['checkin'];
$checkout_date = $_POST['checkout'];
$nAdults = $_POST['adults'];
$nChildren = $_POST['children'];
$room_type = $_POST['room_type'];
$room_view = $_POST['room_view'];
$patio = $_POST['outdoors'];
$nBeds = $_POST['room_beds_number'];

// Check Constraints
if ($checkin_date > $checkout_date) die("Invalid date");

//Open Database connection
include_once "../../global/php/db-functions.php";
$conn = db_connect();

// Search for a room with these specs
$get_rooms = "SELECT * FROM rooms
where rooms.room_type_id = $room_type
AND rooms.room_view = $room_view 
AND rooms.room_patio = $patio
AND rooms.room_beds_number = $nBeds;";

// Check if a room with these options exist
$result_rooms = $conn->query($get_rooms) or die("Query failed");
if (mysqli_num_rows($result_rooms) <= 0) die("No room matches these options");

$book_query = "insert into reservations 
values(
       NULL, 
       1/*TODO Insert client id*/, 
       NULL, 
       '$checkin_date', 
       '$checkout_date', 
       {$nAdults}, 
       {$nChildren}, 
       {$nBeds}, 
       {$room_type}, 
       {$room_view}, 
       {$patio}, 
       0);";

$conn->query($book_query) or die("Query failed");

$conn->close();
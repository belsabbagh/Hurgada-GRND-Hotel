<?php
/*TODO 
    Get list of rooms with specs,
    check reservations of this room if it's free on the given dates,
    book an available room, error if no room is available,
    add booking data to table with respective room number and user data,    
*/
if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
    die("Form was not submitted correctly");
}
// Gather data from POST
$checkin_date = $_POST['checkin'];
$checkout_date = $_POST['checkout'];
$nAdults =  $_POST['adults'];
$nChildren =  $_POST['children'];

$room_type = $_POST['room_type'];
$room_view = $_POST['room_view'];
$patio = $_POST['outdoors'];
$nBeds = $_POST['room_beds_number'];
$ac = $_POST['ac'];
$bath = $_POST['bath'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lab06";
$conn = new mysqli($servername, $username, $password, $dbname);

//Search for a room with these specs
$get_rooms = `select * from rooms 
where room_type_id = '$room_type' 
AND room_view = '$room_view' 
AND room_patio = '$patio'
AND room_beds_number = '$nBeds'
AND room_ac = '$ac'
AND room_bath = '$bath'
AND room_id NOT IN(select room_no from reservations where '$checkin_date' > checkin_date
AND '$checkout_date' < checkiout_date)`;

$result_rooms = $conn->query($get_rooms) or die("Query failed");
if(mysqli_num_rows($result_rooms) <= 0) die("Nothing was found");
$rooms = mysqli_fetch_assoc($result_rooms);
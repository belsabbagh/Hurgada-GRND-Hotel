<?php


include_once "../../global/php/db-functions.php";
$server = "localhost";
$username = "root";
$password = "";
$dbname = "hurgada-grnd-hotel";

$connect = new mysqli($server, $username, $password, $dbname);

if (isset($_POST['reservation_id']))
    $reservation_id = $_POST['reservation_id'];
else echo "error";
$client_ID = get_active_user_id();

//if the user is a client
if (!active_user_isEmployee())
    $return_link = "http://localhost/Hurgada-GRND-Hotel/pages/reservation/my%20reservations.php";

//if the user is a receptionist
else
    $return_link = "http://localhost/Hurgada-GRND-Hotel/pages/reservation_receptionist/clients_reservations.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST') die("Form was not submitted correctly");

// Gather data from POST
if (isset($_POST['submit'])) {
    $overall_rating = $_POST['overall'];
    $view_rating = $_POST['view'];
    $comfort_rating = $_POST['comfort'];
    $facilities_rating = $_POST['facilities'];
    $room_service_rating = $_POST['room_service'];
    $comments = $_POST['comment'];
}

//submit data in db

$room_id_sql = "SELECT room_no FROM reservations WHERE reservation_id = $reservation_id ";
$result = run_query($room_id_sql);
$temp = $result->fetch_assoc();
$room_id = $temp['room_no'];

$submit_sql = "INSERT INTO  room_reviews 
    (client_id, room_id, overall_rating, view_rating, comfort_rating, facilities_rating, room_service_rating, comments, reservation_id)
    VALUES ('$client_ID', '$room_id' , '$overall_rating' ,'$view_rating', '$comfort_rating' , '$facilities_rating'
    , '$room_service_rating', '$comments', '$reservation_id')";
run_query($submit_sql);

header("Location: $return_link");
?>

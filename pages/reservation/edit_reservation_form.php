<?php
include_once "../../global/php/db-functions.php";
maintain_session();




include "../../global/php/db-functions.php";
if ($_SERVER['REQUEST_METHOD'] != 'POST') die("Form was not submitted correctly");
//$client_ID=$_SESSION['active_user_id'];
$client_ID = 1;
// Gather data from POST
$reservation_id = $_POST['reservation_id'];
$checkin_date  = new DateTime($_POST['checkin']);
$checkout_date = new DateTime($_POST['checkout']);
$nAdults = $_POST['adults'];
$nChildren = $_POST['children'];
$extra_bed = $_POST['room_beds_number'];
$room_id = $_POST['room_id'];

$roomsql_2 = "SELECT room_type_id FROM rooms WHERE room_id=$room_id";
$result = run_query($roomsql_2);
$temp = $result->fetch_assoc();
$room_type_id = $temp['room_type_id'];

//echo "$room_type_id";
$roomsql_3 = " SELECT room_max_cap From room_types, rooms WHERE type_id =$room_type_id";
$result = run_query($roomsql_3);
$temp = $result->fetch_assoc();
$room_max_cap = $temp['room_max_cap'];

$room_max_cap = 6;
$max_children = $room_max_cap * 2;

// Check Constraints

// - the date is valid  and check if room is available
$check = room_isAvailable($room_id, $checkin_date, $checkout_date);
if ($checkin_date > $checkout_date || $check == false) die("BAD DATE");

$date_format = "Y-m-d";
$start_date_str = $checkin_date->format($date_format);
$end_date_str = $checkout_date->format($date_format);

$submit_sql = "UPDATE reservations SET 
      start_date = '$start_date_str',
      end_date = '$end_date_str',
      numberof_adults= $nAdults,
      numberof_children= $nChildren,
      extra_bed= $extra_bed
      where reservation_id = $reservation_id";

try {
  $result = run_query($submit_sql);
  header("Location: http://localhost/Hurgada-GRND-Hotel/pages/reservation/my%20reservations.php");
} catch (Exception $e) {
  echo $e->getMessage();
  header("Location: http://localhost/Hurgada-GRND-Hotel/pages/reservation/edit_reservation.php?id=$reservation_id");
}

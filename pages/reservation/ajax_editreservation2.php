<?php
session_start();
include_once "../../global/php/db-functions.php";
$checkin  = new DateTime($_POST['checkin']);
$checkout = new DateTime($_POST['checkout']);
$room_id= $_POST['room_id'];
$reservation_id= $_POST['reservation_id'];
$check = room_isAvailable($room_id, $checkin, $checkout,$reservation_id);
if (!$check)
echo " room is not available on this date";

?>
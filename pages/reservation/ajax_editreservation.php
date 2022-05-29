<?php
session_start();
include "../../global/php/db-functions.php";
$checkin  = new DateTime($_POST['checkin']);
$checkout = new DateTime($_POST['checkout']);
$room_id = $_SESSION['room_no'];
$check = room_isAvailable($room_id, $checkin, $checkout);
if ($checkin > $checkout) {
   // echo" invalid, check out date can not bebefore the check in date"; 
   echo 1;
} 
if (!$check)
   echo 2;
/*else
   echo 3;*/

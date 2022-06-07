<?php
session_start();
include "../../global/php/db-functions.php";
$checkin  = new DateTime($_POST['checkin']);
$checkout = new DateTime($_POST['checkout']);

if ($checkin > $checkout) {
   echo" invalid, check out date can not bebefore the check in date"; 
  
} 


<?php
  session_start();

  include "../../global/php/db-functions.php";
  if (isset($_GET['id']))
    $reservation_id = $_GET['id'];
  else echo "error";
  //$client_ID='$_SESSION['active_id']';
  $client_ID = '1';



  //connection
  $server = "localhost";
  $username = "root";
  $password = "";
  $dbname = "hurgada-grnd-hotel";

  $connect = new mysqli($server, $username, $password, $dbname);
  


  $roomsql_1 = "SELECT room_no FROM reservations WHERE reservation_id= $reservation_id ";
  $result = run_query($roomsql_1);
  $temp = $result->fetch_assoc();
  $room_id = $temp['room_no'];
  $_SESSION['room_no'] = $room_id;


  $roomsql_2 = "SELECT room_type_id FROM rooms WHERE room_id=$room_id";
  $result = run_query($roomsql_2);
  $temp = $result->fetch_assoc();
  $room_type_id = $temp['room_type_id'];

  
  $roomsql_3 = " SELECT room_max_cap From room_types WHERE type_id =$room_type_id";
  $result = run_query($roomsql_3);
  $temp = $result->fetch_assoc();
  $room_max_cap = $temp['room_max_cap'];

  
  $max_children = $room_max_cap * 2;
  if ($_SERVER['REQUEST_METHOD'] != 'POST');

  // Gather data from POST
  if (isset($_POST['submit'])) {
    $checkin_date  = new DateTime($_POST['checkin']);
    $checkout_date = new DateTime($_POST['checkout']);
    $nAdults = $_POST['adults'];
    $nChildren = $_POST['children'];
    $extra_bed = $_POST['room_beds_number'];
  }

  // Check Constraints

  // - the date is valid  and check if room is available
  $check = room_isAvailable($room_id, $checkin_date, $checkout_date);
  /*if (!($checkin_date > $checkout_date || $check == false)) {
    //echo"sfsfs";*/


  $submit_sql = "UPDATE reservations SET 
      start_date = '{$checkin_date->format('Y-m-d')}',
      end_date = '{$checkout_date->format('Y-m-d')}',
      numberof_adults= $nAdults,
      numberof_children= $nChildren,
      extra_bed= $extra_bed
      where reservation_id = $reservation_id";
  //echo "boo";

  $result = $connect->query($submit_sql); //or die("changes were not made, try again"); 


  header("Location:http://localhost/Hurgada-GRND-Hotel/pages/reservation/my%20reservations.php");
  /*} else {

    //header("Locatiom:http://localhost/Hurgada-GRND-Hotel/pages/reservation/edit_reservation.php");
  }*/



  ?>
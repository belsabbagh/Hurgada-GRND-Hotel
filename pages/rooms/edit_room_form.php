<?php
include_once "../../global/php/db-functions.php";
maintain_session();





if ($_SERVER['REQUEST_METHOD'] != 'POST') die("Form was not submitted correctly");

// Gather data from POST
$number_of_beds= $_POST['number_of_beds'];
$base_price= $_POST['base_price'];
$manager_pin= $_POST['manager_pin'];
$room_id= $_POST['room_id'];



/*-------------------------------------------------------------------------------------------*/


  $pin_sql = "SELECT pin from security where pin ='$manager_pin' ";
  $result=run_query($pin_sql);
  if(!empty_mysqli_result($result)){

  $submit_sql = "UPDATE rooms SET 
     room_beds_number= $number_of_beds AND
     room_base_price= $base_price
      where room_id = $room_id";

  try {
    $result = run_query($submit_sql);
    header("Location: http://localhost/Hurgada-GRND-Hotel/pages/rooms/rooms.php");
  } catch (Exception $e) {
    echo $e->getMessage();
    header("Location: http://localhost/Hurgada-GRND-Hotel/pages/rooms/edit_room.php?id=$reservation_id");
  }
}
  else
  echo "wrong pin";

  


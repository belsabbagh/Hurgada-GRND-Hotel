<html> 
<head>
<link href="../../global/css/style.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <script src="functions.js"></script>
     <title> edit reservations </title>
<?php 

 include "../../global/php/db-functions.php"; 

?> 


<link href="../../global/css/style.css" rel="stylesheet">
<link rel="stylesheet" href="./reservation_css.css" />
   <script src="../../global/Template/template.js"></script>
    <link href="style.css" rel="stylesheet">
    <script src="functions.js"></script>
    
<?php $server= "localhost";
$username = "root";
$password = "";
$dbname= "hurgada-grnd-hotel";

$connect = new mysqli($server, $username,$password,$dbname ); ?>

<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HURGHADA-GRND-HOTEL</title>
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- Main JS File -->
    <script src="template.js"></script>
    <!-- Render All Alements Normally -->
    <link rel="stylesheet" href="./normalize.css" />
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="./template.css" />



 <!-- Header -->
 <div class="header" id="header">
        <div class="container">
            <div class="links">
                <span id="icon" class="icon" onclick="showbar()">
                    <i class='bx bx-menu-alt-left'></i>
                </span>
                <div class="items" id="items">
                    <span class="container">
                        <span>Home</span>
                    </span>
                    <span class="container">
                        <span>Rooms</span>
                    </span>
                    <span class="container">
                        <span>Dining</span>
                    </span>
                    <span class="container">
                        <span>Experience</span>
                    </span>
                    <span class="container">
                        <span>Location</span>
                    </span>
                    <span class="container">
                        <span>About</span>
                    </span>
                </div>
                <span id='icon2' class="icon2" onclick="hidebar()">
                    <i class='bx bx-x'></i>
                </span>
                <i class='book' id="book">Book now</i>
                <ul id="bar">
                    <li><a href="Profile"><i class='bx bxs-user'></i> Profile</a></li>
                    <li><a href="MyReservations"><i class='bx bxs-bed'></i> My Reservations</a></li>
                    <li><a href="RateUs"><i class='bx bxs-star'></i> Rate us</a></li>
                    <li><a href="ContacUs"><i class='bx bxl-gmail'></i> Contact us</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Of Header -->

</script>
 </head>

<body> 

<?php

if (isset($_GET['id']))
$reservation_id= $_GET['id'];
else echo "error";
//$client_ID='$_SESSION['active_id']';
$client_ID='1';



 
$server= "localhost";
$username = "root";
$password = "";
$dbname= "hurgada-grnd-hotel";

$connect = new mysqli($server, $username,$password,$dbname );


$roomsql_1= "SELECT room_no FROM reservations WHERE reservation_id= $reservation_id ";
 $result= run_query($roomsql_1);
 $temp = $result->fetch_assoc();
 $room_id =$temp['room_no'];
 

 $roomsql_2= "SELECT room_type_id FROM rooms WHERE room_id=$room_id";
 $result= run_query($roomsql_2);
 $temp = $result->fetch_assoc();
 $room_type_id =$temp['room_type_id'];

 //echo "$room_type_id";
 $roomsql_3 = " SELECT room_max_cap From room_types WHERE type_id =$room_type_id";
 $result= run_query($roomsql_3);
 $temp = $result->fetch_assoc();
 $room_max_cap =$temp['room_max_cap'];

 $room_max_cap=6;
 $max_children = $room_max_cap*2;
?>

<!-- Body -->
<div class="features">
        <div class="container">
            <div class="feat">
               
    <form action="" method="post">
  
  <label for="checkin">Check in date</label>
  <input type="date" id="checkin" name="checkin" onchange="set_date_constraints()">

  <label for="checkout">Check out date</label>
  <input type="date" id="checkout" name="checkout" onchange="set_date_constraints()">


  <label for="adults">Number of adults</label>
  <?php echo "<input type='number' id='adults' name='adults' min='1' max= '$room_max_cap' >"; ?>

  <label for="children">Number of children</label>
  <?php echo" <input type='number' id='children' name='children' min='0' max = '$max_children'>"; ?>

 <input type="number" id="room_beds_number" name="room_beds_number" value="1" min="0" max="1">
  <label for="room_beds_number">extra bed</label>
  <input type="submit" id="submit" name="subpmit" onclick= 'Confirm()'>
            </div>
        </div>
</div>
    


    
</form>
</div>



    <!-- End Of Body -->

<?php 
 if ($_SERVER['REQUEST_METHOD'] != 'POST') die("Form was not submitted correctly");

 // Gather data from POST
 if(isset($_POST['submit'])){
 $checkin_date  = new DateTime ($_POST['checkin']);
 $checkout_date = new DateTime ($_POST['checkout']);
 $nAdults = $_POST['adults'];
 $nChildren = $_POST['children'];
 $extra_bed = $_POST['room_beds_number'];

// Check Constraints
//{
// - the date is valid   
 if ($checkin_date > $checkout_date) die("Invalid date");
// - check if room is available
$check =room_isAvailable ($room_id, $checkin_date, $checkout_date);
if($check==false) die ("room is not available on the inserted date");
//}
 
$submit_sql= "UPDATE reservations SET 
start_date = '{$checkin_date->format('Y-m-d')}',
end_date = '{$checkout_date->format('Y-m-d')}',
numberof_adults= $nAdults,
numberof_children= $nChildren,
extra_bed= $extra_bed
where reservation_id = $reservation_id";

$result = $connect->query($submit_sql) or die("changes were not made, try again");

 }
?>

 <!-- Footer -->
 <div class="footer">
        &copy; 2022
        <span>MIU</span>
        All Rights Reserved
    </div>
    <!-- End Of Footer -->

</body>

</html>
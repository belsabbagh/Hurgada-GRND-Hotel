<html>

<head>
  <?php   include_once "../../global/php/db-functions.php";
    maintain_session();
    redirect_to_login();?>
  
  <link href="../../global/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="./reservation_css.css" />
  <script src="functions.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title> edit reservations </title>
  
  <style>
    .shadow {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      height: 550px;
      padding-top: 15%;
      border-radius: 30px;
      width: 120%;
      color: #7b5c52;

    }

    .container2 {
      margin-bottom: 45%;
      margin-right: 5%;
      margin-left: 30%;


    }

    input {
      float: right;
      padding-left: 50%;
      text-align: center;


    }

    #submit {
      padding-left: 25%;
      padding-right: 25%;

    }

    .row {


      padding-top: 80px;
      padding-right: 50%;
      font-size: larger;
      margin-right: 70%;
    }
  </style>


  <link href="../../global/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="./reservation_css.css" />
  <script src="../../global/Template/template.js"></script>
  <link href="style.css" rel="stylesheet">
  <script src="functions.js"></script>
  <?php

 if (isset($_GET['id']))
 $reservation_id = $_GET['id'];

$server = "localhost";
  $username = "root";
  $password = "";
  $dbname = "hurgada-grnd-hotel";

  $connect = new mysqli($server, $username, $password, $dbname);
  


  $roomsql_1 = "SELECT room_no FROM reservations WHERE reservation_id= $reservation_id ";
  $result = run_query($roomsql_1);
  $temp = $result->fetch_assoc();
  $room_id = $temp['room_no'];
  


  $roomsql_2 = "SELECT room_type_id FROM rooms WHERE room_id=$room_id";
  $result = run_query($roomsql_2);
  $temp = $result->fetch_assoc();
  $room_type_id = $temp['room_type_id'];
?>



  <script>
    error_msg1 = " invalid, check out date can not bebefore the check in date"
    error_msg2 = " room is not available"
    msg = "valid"
    


    function check_availability(){

      jQuery.ajax({
        url: "ajax_editreservation2.php",
        data: 'checkout=' + $("#checkout").val() + "&" + 'checkin=' + $("#checkin").val()+"&"+ 'room_id=' + $("#room_id").val()+ "&"+ 'reservation_id=' + $("#reservation_id").val(),
        type: "POST",

        success: function(data) {
       
          $("#warning2").html(data);
          
        }

      });

    }

    function checkdate() {

      jQuery.ajax({
        url: "ajax_editreservation.php",
        data: 'checkout=' + $("#checkout").val() + "&" + 'checkin=' + $("#checkin").val()+"&",
        type: "POST",

        success: function(data) {
       
          $("#warning").html(data);
         
        }

      });


    }
  </script>

  

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
        <?php echo load_header_bar(get_active_user_type()); ?>>
        </div>
        <span id='icon2' class="icon2" onclick="hidebar()">
          <i class='bx bx-x'></i>
        </span>
        <i class='book' id="book"><a href="<?php echo REPOSITORY_PAGES_URL . "booking" ?>">Book now</a></i>
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


</head>

<body >




  <!-- Body -->
  <div class="features" >
    <div class="container2">
      <div class="row col-md-12">
        <div class="shadow col-md-6 mt-5 "onmouseover="checkdate(); check_availability()" "  >


          <h2 class="titles"> Edit your reservation </h2>
          <form action="edit_reservation_form.php" method="post">
            
            <input type="hidden" name="room_id" id="room_id" value="<?php echo $room_id?>">
            <input type="hidden" name="reservation_id" id="reservation_id" value="<?php echo $_GET['id'] ?>">

            <div class="dates form-group">
              <label for="checkin">Check in date</label>
              <input type="date" id="checkin" name="checkin" required  />
            </div>
            <div class="dates form-group">
              <label for="checkout">Check out date</label>
              <input type="date" id="checkout" name="checkout" required />
              <P id="warning"> </p>
              <P id="warning2" style=" color: red; font-size: small;"> </p>
            </div>

            <div class="num-of-occupants form-group">
              <label for="adults">Number of adults</label>
              <input type="number" id="adults" name="adults" min="1" max="4" value="1" required />
            </div>
            <div class="num-of-occupants form-group">
              <label for="children">Number of children</label>
              <input type="number" id="children" name="children" min="0" max="8" value="0" required />
            </div>
            <div class="num-of-occupants form-group">
              <label for="room_beds_number">extra bed</label>
              <input type="number" id="room_beds_number" name="room_beds_number" value="1" min="0" max="1" required>
            </div>

            <input type="submit" class="submit" id="submit" name="submit">

          </form>

        </div>

      </div>
    </div>
  </div>


  <!-- End Of Body -->

  <!-- Footer -->
  <div class="footer">
    &copy; 2022
    <span>MIU</span>
    All Rights Reserved
  </div>
  <!-- End Of Footer -->





</body>


</html>



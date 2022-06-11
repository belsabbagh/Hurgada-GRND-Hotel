<html>

<head>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet" href="./msg_.css" />
  <link href="style.css" rel="stylesheet">
  <script src="functions.js"></script>

  <title> delete reservations </title>
  <?php include_once "../../global/php/db-functions.php";
    maintain_session();
    redirect_to_login();
  $server = "localhost";
  $username = "root";
  $password = "";
  $dbname = "hurgada-grnd-hotel";
  $connect = new mysqli($server, $username, $password, $dbname);
  ?>
</head>

<body>

  <?php
  // confirm msg
  $delete_msg = "are you sure you want to delete?";
  $delete_header = "delete reservation";

  confirmmsg($delete_msg, $delete_header);
  //not confirmed, go back to my reservations

  //if the user is a client
  if (!active_user_isEmployee())
  $return_link="http://localhost/Hurgada-GRND-Hotel/pages/reservation/my%20reservations.php";

  //if the user is a receptionist
  else
  $return_link="http://localhost/Hurgada-GRND-Hotel/pages/reservation_receptionist/clients_reservations.php";

  if (isset($_POST["no_btn"])) {

    header("Location:$return_link");
  }

  //deleting is confirmed 
  else if (isset($_POST["yes_btn"])) {


    $id = $_GET['id'];
    $sql = "DELETE FROM reservations WHERE reservation_id=$id";
    $result = $connect->query($sql);
    //if reservation was deleted
    if ($result) {
      $deleted_msg = "reservation deleted";
      $deleted_header = "deleted";
      $deleted_link = $return_link;
      warningmsg($deleted_msg, $deleted_header, $deleted_link);
    }


    //if reservation wasn't deleted, error occured 
    else {

      $error_msg = "reservation was not deleted";
      $error_header = "error";
      $error_link = $return_link;
      warningmsg($error_msg, $error_header, $error_link);
    }
  }
  ?>

</body>

</html>
<html> 
<head> 
<script src= "https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="./msg_.css" />
   
    <link href="style.css" rel="stylesheet">
    <script src="functions.js"></script>
     <title> check in </title>
<?php include_once "../../global/php/db-functions.php";
    maintain_session();
    redirect_to_login();

$server= "localhost";
$username = "root";
$password = "";
$dbname= "hurgada-grnd-hotel";

$connect = new mysqli($server, $username,$password,$dbname );

if (isset($_GET['id']))
$reservation_id= $_GET['id'];
else echo "error";
$client_ID= get_active_user_id();

?> </head>

<body>

<?php
 
 //if the user is a client
 if (!active_user_isEmployee())
 $return_link="http://localhost/Hurgada-GRND-Hotel/pages/reservation/my%20reservations.php";

 //if the user is a receptionist
 else
 $return_link="http://localhost/Hurgada-GRND-Hotel/pages/reservation_receptionist/clients_reservations.php";


$check_in_msg= "are you sure you want to check in?";
$check_in_header= "check in ";

 confirmmsg ($check_in_msg ,$check_in_header);
 //not confirmed, go back to my reservations
if( isset($_POST["no_btn"])){

    header ("Location:$return_link");

}

//confirmed 
else if (isset($_POST["yes_btn"])){
// check if current date is the same as the start date
//1)get current date
$current_date= new DateTime();

//2)get start date
$sql= "SELECT start_date FROM reservations WHERE reservation_id = $reservation_id";
$result= (mysqli_query($connect, $sql));
$temp = $result->fetch_assoc();
$start_date = new DateTime ($temp['start_date']);

//3) get end date 
$sql2= "SELECT end_date FROM reservations WHERE reservation_id = $reservation_id";
$result= (mysqli_query($connect, $sql2));
$temp = $result->fetch_assoc();
$end_date = new DateTime ($temp['end_date']);


//check if date is valid
if($current_date<$start_date || $current_date>$end_date){
//
$failled_to_checkin_link= $return_link;
$failled_to_checkin_header= "can not check in";
$failled_to_checkin_msg= "you can't check in before the start date";
warningmsg ($failled_to_checkin_msg,$failled_to_checkin_header,$failled_to_checkin_link);

}

else{
    $check_in_sql= "UPDATE reservations SET is_checked_in = 1 where reservation_id =$reservation_id";
mysqli_query($connect,$check_in_sql) or die ("failled to check in");
header ("Location: $return_link");

}
}


?>
</body>

</html>
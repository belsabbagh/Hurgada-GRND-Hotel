<html> 
<head> 
<link href="../../global/css/style.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <script src="functions.js"></script>
     <title> check in </title>
<?php include "../../global/php/db-functions.php"; 

$server= "localhost";
$username = "root";
$password = "";
$dbname= "hurgada-grnd-hotel";

$connect = new mysqli($server, $username,$password,$dbname );

if (isset($_GET['id']))
$reservation_id= $_GET['id'];
else echo "error";
//$client_ID='$_SESSION['active_id']';
$client_ID=1;
?> </head>

<body>

<?php
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
 echo " cant check in before start date";
header ("Location:http://localhost/Hurgada-GRND-Hotel/pages/reservation/my%20reservations.php");
}

else{
    $check_in_sql= "UPDATE reservations SET is_checked_in = 1 where client_id = $client_ID AND reservation_id =$reservation_id";
mysqli_query($connect,$check_in_sql) or die ("failled to check in");
header ("Location:http://localhost/Hurgada-GRND-Hotel/pages/reservation/my%20reservations.php");

}

//check in confirmation msg 
//
?>
</body>

</html>
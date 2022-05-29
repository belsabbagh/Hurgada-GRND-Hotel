<html> 
<head> 
<link href="../../global/css/style.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <script src="functions.js"></script>
     <title> checking out </title>
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
?> 

</head>

<body> <?php

$check_out_sql= "UPDATE reservations SET is_checked_in = 0 where client_id = $client_ID AND reservation_id =$reservation_id";
$result =mysqli_query($connect,$check_out_sql) or die ("failled to check out");

//checkout msg

// rate us pop msg, with options: give rating, no thanks
//rating 
if(!$result)
header("http://localhost/Hurgada-GRND-Hotel/pages/reservation/my%20reservations.php");
else
header ("Location:http://localhost/Hurgada-GRND-Hotel/pages/reservation/rating.php");
?>

</body>

</html>
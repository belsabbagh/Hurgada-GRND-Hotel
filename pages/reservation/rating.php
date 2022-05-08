<html> 
<head>
<link href="../../global/css/style.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <script src="functions.js"></script>
     <title> rating </title>
<?php include "../../global/php/db-functions.php"; ?>



<?php 
if (isset($_GET['id']))
$reservation_id= $_GET['id'];
else echo "error";
//$client_ID='$_SESSION['active_id']';
$client_ID='1';
// make a skip rating option ?>
     </head>    

<body>

<h2> rate us! </h2>
<form action="" method="post">

<div class="slidecontainer">
<label for="over all rating">over all rating </label>
<input type="range" min="1" max="100" value="50" class="slider" id="overall">
</div>

<div class="slidecontainer">
<label for="view rating"> view rating </label>
<input type="range" min="1" max="100" value="50" class="slider" id="view">
</div>

<div class="slidecontainer">
<label for="comfort rating"> comfort rating </label>
<input type="range" min="1" max="100" value="50" class="slider" id="comfort">
</div>

<div class="slidecontainer">
<label for="facilities rating"> facilities rating </label>
<input type="range" min="1" max="100" value="50" class="slider" id="facilities">
</div>

<div class="slidecontainer">
<label for="room service rating"> room service rating </label>
<input type="range" min="1" max="100" value="50" class="slider" id="room service">
</div>


<div class="num-of-occupants">
        <label for="comments and suggestions"> comments and suggestions</label>
        <input type='text' id='comment' name='comment' > </div>

    <input type="submit" id="submit" name="submit">
</form>


<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') die("Form was not submitted correctly");

// Gather data from POST
if(isset($_POST['submit'])){
$overall_rating= $_POST['overall'];
$view_rating= $_POST['view'];
$comfort_rating= $_POST['comfort'];
$facilities_rating= $_POST['facilities'];
$room_service_rating= $_POST['room service'];
$comments= $_POST['comment'];
}

//submit data in db

$room_id_sql= "SELECT room_no FROM reservations WEHRE reservation_ID =$reservation_id ";
$result= run_query($room_id_sql);
$temp = $result->fetch_assoc();
$room_id =$temp['room_no'];

$submit_sql= "INSERT INTO  room_reviews 
(client_id, room_no, overall_rating, view_rating, comfort_rating, facilities_rating, room_service_rating, comments, reservation_id)
VALUES ('$client_ID', '$room_id' , '$overall_rating' ,'$view_rating', '$comfort_rating' , '$facilities_rating'
, '$room_service_rating', '$comments', '$reservation_id')";
run_query($submit_sql) or die(" error");

header ("Location:http://localhost/Hurgada-GRND-Hotel/pages/reservation/my%20reservations.php");

?>
</body>
</html
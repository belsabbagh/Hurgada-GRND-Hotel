<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbDatabase = 'hurgada-grnd-hotel';
$db = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbDatabase)
or die ("Unable to connect to Database Server.");
$email = $_GET['email'];
$sql_check = "SELECT email from users where email='$email' ";
$result = $db->query($sql_check) or die("failed");
if (mysqli_num_rows($result) > 0) {
    echo '<font color="red">The email <strong>' . $email . '</strong>' . ' is valid.</font>';
} else {
    echo 'enter valid email';
}
?>
<html lang="en">
<head><title> delete reservations </title>
    <?php include "../../global/php/db-functions.php"; ?>
</head>

<body>
<?php

$id = $_GET['id'];
$sql = "DELETE FROM reservations WHERE reservation_id=$id";
run_query($sql) or die ("error");

header("Location: http://localhost/Hurgada-GRND-Hotel/pages/reservation/my_reservations.php");
?>

</body>

</html>
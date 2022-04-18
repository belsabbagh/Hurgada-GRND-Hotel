<html> 
<head> <title> delete reservations </title>
<?php include 'connection.php'?>  </head>

<body>
 <?php
 
$id= $_GET['id'];
$sql = "DELETE FROM reservations WHERE id=$id";
$result = $connect->query($sql) or die ("error");

header ("Location:my_reservations.php");
?>

</body>

</html>
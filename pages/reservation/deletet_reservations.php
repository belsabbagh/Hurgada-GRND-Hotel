<html> 
<head> <title> delete reservations </title>
<?php include 'connection.php'?>  </head>

<body>
<?php

$sql = " delete from table reservations where col = 'val'";

$result = mysqli_querey( $connection, $sql);
if ($result) echo "deleted";
else echo "failed";
?>    

</body>

</html>
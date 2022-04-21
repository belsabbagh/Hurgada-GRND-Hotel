<html lang="en">
<head>     <?php include "../../global/php/db-functions.php"; ?>

    <title> my reservations</title></head>

<body>
<?php

$email = '';
// get the id of the user
//$client_ID='$_SESSION['active_id']';
$client_ID = '1';
$sql = "select reservation_id, room_no, start_date, end_date, numberof_adults, numberof_children,
is_checked_in from reservations where client_id= '$client_ID' ";
$result = run_query($sql);

if ($result->num_rows == 0)
echo "no reservations";
else
{
?>
<p>
<table>
    <tr>
        <th
        <h1> reserverations </h1></th>
        <th> reservation id</th>
        <th> Room number</th>
        <th> checked in</th>
        <th> checked out</th>
        <th> numberof_adults</th>
        <th> numberof_children</th>
        <th> numberof_beds</th>
        <th> room_type_id</th>
        <th> room_view_id</th>
        <th> patio</th>
        <th> edit/delete </th>
   
     
    
</tr>

<?php
while ($row = $result->fetch_assoc())
{

    echo "<tr><td>" . $row["reservation_id"] . "</td><td>" . $row["room_no"] . " " . $row["start_date"] . "</td> 
  <td>" . $row["end_date"] . "</td>
  <td>" . $row["numberof_adults"] . "</td>
  <td>" . $row["numberof_children"] . "</td>

  ";
    $id = $row['reservation_id'];
    echo "<td><a href='edit_reservation.php?id=$id'> edit </a> </td>";
    echo "<td><a href='delete_reservations.php?id=$id'> delete </a> </td></tr>";

    /*  echo " <td> <form method='POST' action='edit_reservation.php'>
      <input type='submit' value='edit'/>
    </form> </td>";
      echo " <td> <form method='POST' action=''>
      <input type='submit' value='delete'/>
    </form> </td></tr>";*/
  
}

}
?>
</table>




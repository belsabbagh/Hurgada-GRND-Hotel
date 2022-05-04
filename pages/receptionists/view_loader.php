<?php
include_once "../../global/php/db-functions.php";
const directory_url = "http://localhost/Hurgada-GRND-Hotel/pages/receptionists";

function construct_receptionists_table(mysqli_result $receptionists_data): string
{
    $table = "<table><tr><th>Receptionist ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>View</th><th>Edit</th><th>Delete</th></tr>";
    while ($receptionist = $receptionists_data->fetch_assoc())
        $table .= construct_receptionist_table_row($receptionist);
    return $table . "</table>";
}

function construct_receptionist_table_row($receptionist): string
{
    $directory_url = directory_url;
    $color = "";
    if ($receptionist["receptionist_enabled"] == 0) $color = "style='background-color: red;'";
    return "<tr $color>
                <td>{$receptionist['user_id']}</td>
                <td>{$receptionist['first_name']}</td>
                <td>{$receptionist['last_name']}</td>
                <td>{$receptionist['email']}</td>
                <td><a href='$directory_url/view-receptionist.php?id={$receptionist["user_id"]}'>View</a></td>
                <td><a href='$directory_url/edit-receptionist.php?id={$receptionist["user_id"]}'>Edit</a></td>
                <td><a href='$directory_url/delete-receptionist.php?id={$receptionist["user_id"]}'>Delete</a></td>
            </tr>";
}
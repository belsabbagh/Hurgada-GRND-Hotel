<?php
include_once "view_loader.php";
include_once "../../global/php/db-functions.php";

if (array_key_exists('id', $_GET))
{
    $content = construct_receptionist_view(get_user_by_id($_GET["id"]), array_key_exists('editable', $_GET));
    echo construct_template($content);
    return;
}
try
{
    $data = get_receptionists();
    $content = construct_receptionists_table($data) . "<a class='view-button' href='http://localhost/Hurgada-GRND-Hotel/pages/receptionists/new-receptionist.php'>Add New Receptionist</a>";
} catch (Exception $e)
{
    $content = "<p>" . $e->getMessage() . "</p>";
}

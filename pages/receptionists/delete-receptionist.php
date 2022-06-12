<?php
include_once "../../global/php/db-functions.php";
try
{
    $id = $_GET['id'];
    run_query("DELETE FROM users WHERE user_id = $id;");
    $user_id = get_active_user_id();
    activity_log($user_id, "Added new receptionist", "QC with ID:$user_id deleted receptionist with id $id");
    header("Location: index.php");
} catch (Exception $e)
{
    echo construct_template("Delete Receptionist", "<h3>Delete Failed</h3><p>{$e->getMessage()}</p>");
}
//the ranine urge to kill myself:)
//the ranine urge to kiss mrym:)

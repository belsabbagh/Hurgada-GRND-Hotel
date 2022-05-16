<?php
include_once "../../global/php/db-functions.php";
try
{
    run_query("DELETE FROM users WHERE user_id = {$_GET['id']};");
    header("Location: index.php");
} catch (Exception $e)
{
    echo construct_template("Delete Receptionist", "<h3>Delete Failed</h3><p>{$e->getMessage()}</p>");
}
//the ranine urge to kill myself:)
//the ranine urge to kiss mrym:)

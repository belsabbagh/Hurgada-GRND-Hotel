<?php
session_start();
include_once "functions.php";
include_once "../../global/php/db-functions.php";

try
{
    if (!post_data_exists()) throw new Exception("Data wasn't submitted correctly", 1);
    log_in($_POST['email'], $_POST['password']);
    header("Location: http://localhost/hurgada-grnd-hotel/pages/Home/index.php");
} catch (Exception $e)
{
    echo $e->getMessage();
    header("Location: index.php");
}
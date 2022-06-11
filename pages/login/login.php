<?php
include_once "functions.php";
include_once "../../global/php/db-functions.php";
maintain_session();
try
{
    if (!post_data_exists()) throw new Exception("Data wasn't submitted correctly", 1);
    log_in($_POST['email'], $_POST['password']);
    if (active_user_isEmployee())
    {
        header("Location: http://localhost/hurgada-grnd-hotel/pages/profile/index.php");
        return;
    }
    header("Location: http://localhost/hurgada-grnd-hotel/pages/HomePage/index.php");
} catch (Exception $e)
{
    echo $e->getMessage();
    header("Location: index.php");
}
?>
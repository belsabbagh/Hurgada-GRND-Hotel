<?php
session_start();
include("functions.php");
include "../../global/php/db-functions.php";

/**
 * @throws Exception Exception if error occurs
 */
function log_in(): void
{
    if (!post_data_exists()) throw new Exception("Data wasn't submitted correctly");
    //something was posted
    $email = $_POST['email'];
    $password = $_POST['password'];

    //read from database
    $query = "select * from users where email = '$email' and password = '$password' ";
    try {
        $result = run_query($query);
        if (empty_mysqli_result($result)) throw new Exception("Incorrect credentials");
        $user_data = mysqli_fetch_assoc($result);
        $_SESSION['active_email'] = $user_data['email'];
        $_SESSION['active_user_id'] = $user_data['user_id'];
        $_SESSION['active_user_type'] = $user_data['user_type'];
        header("Location: http://localhost/hurgada-grnd-hotel/pages/Home/index.html");
        return;
    } catch (Exception $e) {
        echo $e->getMessage();
        //header("Location: index.html");
    }
}

try {
    log_in();
} catch (Exception $e) {
    echo $e->getMessage();
}
<?php
include_once "../../global/php/db-functions.php";
try {
    run_query("DELETE FROM users WHERE user_id = {$_GET['id']};");
    log_out();
    header("Location: ../../pages/login/index.php");
} catch (Exception $e) {
    echo construct_template("Delete user", "<h3>Delete Failed</h3><p>{$e->getMessage()}</p>");
}
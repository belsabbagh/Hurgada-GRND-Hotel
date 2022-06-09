<?php
include_once "../../global/php/db-functions.php";
try {
    $parent_id = get_active_user_id();
    run_query("DELETE FROM dependants WHERE dependant_id = {$_GET['id']} AND parent_id=$parent_id;");
    header("Location: ../../pages/profile/dependants.php");
} catch (Exception $e) {
    echo construct_template("Delete dependants", "<h3>Delete Failed</h3><p>{$e->getMessage()}</p>");
}
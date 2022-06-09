<?php
include_once "../../global/php/db-functions.php";
try {
    run_query("DELETE FROM dependants WHERE parent_id = {$_GET['id']};");
    header("Location: ../../pages/profile/dependants.php");
} catch (Exception $e) {
    echo construct_template("Delete dependants", "<h3>Delete Failed</h3><p>{$e->getMessage()}</p>");
}
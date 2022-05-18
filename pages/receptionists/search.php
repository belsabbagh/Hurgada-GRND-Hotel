<?php
include_once "view_loader.php";
include_once "../../global/php/db-functions.php";

if(!post_data_exists()) die("No POST");

echo $_POST['property'];
$data = get_receptionists($_POST['property'], $_POST['key']);
echo construct_receptionists_table($data);

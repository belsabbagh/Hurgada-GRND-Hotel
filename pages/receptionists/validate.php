<?php
include_once "view_loader.php";
include_once "../../global/php/db-functions.php";
if(!post_data_exists()) die("No POST");
if (user_email_exists($_POST['key'])) echo 1;
else echo 0;

<?php
include_once "../../php/db-functions.php";
//if (!post_data_exists()) echo "No POST";
echo intval(user_email_exists($_GET['key']));

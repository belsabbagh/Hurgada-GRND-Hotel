<?php
include_once "../../php/db-functions.php";
echo intval(user_email_exists($_GET['key']));
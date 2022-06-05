<?php
include_once "../../php/db-functions.php";
if (!post_data_exists()) echo "No POST";
if (user_email_exists($_POST['key'])) echo 1;
else echo 0;

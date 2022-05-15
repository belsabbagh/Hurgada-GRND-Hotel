<?php
include_once "view_loader.php";
include_once "../../global/php/db-functions.php";
echo construct_template("New Receptionist", construct_new_receptionist_form());
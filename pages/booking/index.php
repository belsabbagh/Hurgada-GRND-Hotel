<?php
include_once "../../global/php/db-functions.php";
include_once "form_loader.php";
echo construct_template(construct_new_booking_form(active_user_isEmployee()));

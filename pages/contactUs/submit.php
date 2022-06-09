<?php
include_once "../../global/php/db-functions.php";

try
{
    if (!post_data_exists()) throw new Exception("Form wasn't submitted correctly.");
    $sql = "INSERT INTO contactus_suggestions(email,review) VALUES ({$_POST['email']},{$_POST['review']})";
    run_query($sql);
    echo "Added suggestion successfully.";
    header(HOME_URL);
} catch (Exception $e)
{
    echo "Failed to create entry";
    go_back_to_previous_page();
}
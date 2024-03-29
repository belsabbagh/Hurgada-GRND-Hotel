<?php
include_once "../../global/php/db-functions.php";
include_once 'view_loader.php';

/**
 * @author @Belal-Elsabbagh
 *
 * @throws Exception Emits Exception in case of an error.
 */
function add_new_receptionist(): void
{
    if (!post_data_exists()) throw new ErrorException("Form was not submitted correctly", 1);
    $enabled = array_key_exists('enabled', $_POST) ? 1 : 0;
    if (user_email_exists($_POST['email'])) throw new LogicException("Email Already Exists");

    $pfp_file_name = insert_pic_into_directory($_FILES['user_pic'], $_POST['email'], PFP_DIRECTORY_PATH);
    $idp_file_name = insert_pic_into_directory($_FILES['national_id_photo'], $_POST['email'], ID_PIC_DIRECTORY_PATH);

    $sql = "INSERT INTO users (email, first_name, last_name, password, national_id_photo, user_pic, user_type, receptionist_enabled, receptionist_qc_comment) 
            VALUES ('{$_POST['email']}', '{$_POST['first_name']}', '{$_POST['last_name']}', '{$_POST['password']}', '$idp_file_name', '$pfp_file_name', 2, $enabled, '{$_POST['qc_comment']}')";
    try
    {
        run_query($sql);
    } catch (mysqli_sql_exception $e)
    {
        echo $e->getMessage();
        throw new RuntimeException("Failed to add new Receptionist.", 686, $e);
    }
}

$result = "Operation successful";
try
{
    add_new_receptionist();
    $user_id = get_active_user_id();
    activity_log($user_id, "Added new receptionist", "QC with ID:$user_id added a new receptionist");
    header("Location: index.php");
} catch (Exception $e)
{
    $result = '<p>' . $e->getMessage() . '</p>';
} finally
{
    echo construct_template("Add Receptionist", $result);
}
<?php
const pfp_directory_path = "../../resources/img/user_pics/";
const id_pic_directory_path = "../../resources/img/id_pics/";
include_once "../../global/php/db-functions.php";
include_once 'view_loader.php';
/**
 * Takes a submitted picture, renames it to the user's email, and moves it to the given directory to be stored.
 *
 * @author @Belal-Elsabbagh
 *
 * @param array  $pic           The submitted picture
 * @param string $new_filename  The desired file name.
 * @param string $directory     The folder where the file will go
 *
 * @var string   $pic_extension The picture's extension.
 * @var string   $pic_filename  The full new image file name.
 * @return string The full new image file name.
 */
function insert_pic_into_directory(array $pic, string $new_filename, string $directory): string
{
    $pic_info = pathinfo($pic['name']);
    $pic_extension = $pic_info['extension'];
    $pic_filename = $new_filename . '.' . $pic_extension;
    move_uploaded_file($pic['tmp_name'], $directory . $pic_filename);
    return $pic_filename;
}

/**
 * @author @Belal-Elsabbagh
 *
 * @throws Exception Emits Exception in case of an error.
 */
function add_new_receptionist(): void
{
    if (!($_SERVER['REQUEST_METHOD'] == 'POST')) throw new ErrorException("Form was not submitted correctly", 1);
    $enabled = array_key_exists('enabled', $_POST) ? 1 : 0;

    $pfp_file_name = insert_pic_into_directory($_FILES['user_pic'], $_POST['email'], pfp_directory_path);
    $idp_file_name = insert_pic_into_directory($_FILES['national_id_photo'], $_POST['email'], id_pic_directory_path);

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
} catch (Exception $e)
{
    $result = '<p>' . $e->getMessage() . '</p>';
} finally
{
    echo construct_template($result);
}
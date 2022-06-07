<?php
include_once "../../global/php/db-functions.php";
/**
 * Adds the new user data into the db and saves their photos in their folders.
 *
 * @author @rdahshan
 * @throws Exception Emits exception in case of error
 */
function signUp(): void
{
    if (!post_data_exists())
        throw new RuntimeException("{$_SERVER['REQUEST_METHOD']} form isn't submitted to the database.");

    if (!fileUploaded('user_pic') || !fileUploaded('national_id_photo'))
        throw new RuntimeException("image not uploaded into the database.");

    $pfp_name = insert_pic_into_directory($_FILES['user_pic'], $_POST['email'], PFP_DIRECTORY_PATH);
    $id_name = insert_pic_into_directory($_FILES['national_id_photo'], $_POST['email'], ID_PIC_DIRECTORY_PATH);

    try
    {
        $sql = "INSERT INTO users 
            (first_name, last_name, email, password, user_pic, national_id_photo, user_type) 
            VALUES 
            ('{$_POST['first_name']}','{$_POST['last_name']}','{$_POST['email']}','{$_POST['password']}',
            '$pfp_name' ,'$id_name',3);";
        run_query($sql);
    } catch (Exception $e)
    {
        echo $e->getMessage();
        throw new RuntimeException("unable to signup.");
    }

}

$content = "successful.";
try
{
    signUp();
    header("Location: localhost/Hurgada-GRND-Hotel/pages/home/index.html");
} catch (Exception $e)
{
    $content = $e->getMessage();
}
echo construct_template('Sign Up', $content);

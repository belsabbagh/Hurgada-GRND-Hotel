<?php
include_once "../../global/php/db-functions.php";
maintain_session();
/**
 * Adds the new user data into the db and saves their photos in their folders.
 *
 * @author rdahshan
 * @throws Exception Emits exception in case of error
 */
function signUp(): void
{
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
    if (!post_data_exists())
        throw new RuntimeException("{$_SERVER['REQUEST_METHOD']} form isn't submitted to the database.");
    signUp();
    activity_log(get_user_id_from_email($_POST['email']), "Sign Up", "New User signed up.");
    log_in($_POST['email'], $_POST['password']);
    header("Location: " . LOGIN_URL);
} catch (Exception $e)
{
    $content = $e->getMessage();
}
echo construct_template('Sign Up', $content);

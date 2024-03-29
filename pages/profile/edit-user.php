<?php
include_once "../../global/php/db-functions.php";
function edit(): void
{

    if (fileUploaded('user_pic')) insert_pic_into_directory($_FILES['user_pic'], $_POST['email'], PFP_DIRECTORY_PATH);
    if (fileUploaded('national_id_photo')) insert_pic_into_directory($_FILES['national_id_photo'], $_POST['email'], ID_PIC_DIRECTORY_PATH);

    try {
        $user_id = get_active_user_id();
        $sql = "UPDATE users set
        first_name='{$_POST['first_name']}', last_name='{$_POST['last_name']}', email='{$_POST['email']}', password='{$_POST['password']}'
        WHERE user_id=$user_id";

        run_query($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
        throw new RuntimeException("unable to signup.");
    }

}

$content = "successful.";
try {
    if (!post_data_exists())
        throw new RuntimeException("{$_SERVER['REQUEST_METHOD']} form isn't submitted to the database.");
    edit();
    activity_log(get_user_id_from_email($_POST['email']), "Sign Up", "New User signed up.");
    log_in($_POST['email'], $_POST['password']);
    header("Location: " . LOGIN_URL);
} catch (Exception $e) {
    $content = $e->getMessage();
}
echo construct_template('edit-user', $content);
?>

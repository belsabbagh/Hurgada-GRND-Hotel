<?php
include_once "../../global/php/db-functions.php";
function edit(): void
{

    $user_id = get_active_user_id();
    $file_name = get_email_from_user_id($user_id) . $_POST['dependant_name'] . $_POST['relationship'];
    $idp_file_name = insert_pic_into_directory($_FILES['identification'], $file_name, ID_PIC_DIRECTORY_PATH);
    $isChild = array_key_exists('isChild', $_POST) ? 1 : 0;

    try {
        $user_id = get_active_user_id();
        $sql = "UPDATE dependants set
        dependant_name='{$_POST['dependant_name']}', relationship='{$_POST['relationship']}', identification='$idp_file_name', 
        child='$isChild'
        WHERE parent_id=$user_id";

        run_query($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
        throw new RuntimeException("unable to add dependant.");
    }

}

$content = "successful.";
try {
    if (!post_data_exists())
        throw new RuntimeException("{$_SERVER['REQUEST_METHOD']} form isn't submitted to the database.");
    edit();
    activity_log(get_active_user_id(), "Edit dependant", "New dependant edited.");
    go_back_to_previous_page();
} catch (Exception $e) {
    $content = $e->getMessage();
}

?>

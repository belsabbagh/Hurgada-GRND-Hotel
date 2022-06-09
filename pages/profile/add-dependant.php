<?php
include_once "../../global/php/db-functions.php";
include_once "view-loader.php";
function add_new_dependant(): void
{
    if (!post_data_exists()) throw new ErrorException("Form was not submitted correctly", 1);

    $parent_id = get_active_user_id();
    $file_name = get_email_from_user_id($parent_id) . $_POST['dependant_name'] . $_POST['relationship'];
    $idp_file_name = insert_pic_into_directory($_FILES['identification'], $file_name, ID_PIC_DIRECTORY_PATH);
    $isChild = array_key_exists('isChild', $_POST) ? 1 : 0;
    $sql = "INSERT INTO dependants (dependant_name, relationship, identification, child, parent_id)
VALUES ('{$_POST['dependant_name']}', '{$_POST['relationship']}', '$idp_file_name', $isChild, $parent_id)";
    try {
        run_query($sql);
    } catch (mysqli_sql_exception $e) {
        echo $e->getMessage();
        throw new RuntimeException("Failed to add new Receptionist.", 686, $e);
    }
}

try {
    add_new_dependant();
    go_back_to_previous_page();
} catch (Exception $e) {
    echo "failed to add dependant";
}
?>

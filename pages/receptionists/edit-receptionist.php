<?php
include_once "../../global/php/db-functions.php";

function construct_edit_query_from_POST(): string
{
    $parameter_constructor = function (string $attribute, bool $isString): string
    {
        $new = $isString ? "'$_POST[$attribute]'" : $_POST[$attribute];
        return "$attribute = $new";
    };
    $first_name = $parameter_constructor("first_name", true) . ", ";
    $last_name = $parameter_constructor("first_name", true) . ", ";
    $email = $parameter_constructor('email', true) . ", ";
    $user_type = $parameter_constructor('user_type', false) . ", ";
    $enabled = (array_key_exists('receptionist_enabled', $_POST) ?
            $parameter_constructor('receptionist_enabled', false) : "receptionist_enabled = 0") . ", ";
    $qc_comment = $parameter_constructor('receptionist_qc_comment', true);

    $new_values = $first_name . $last_name . $email . $user_type . $enabled . $qc_comment;
    return "UPDATE users SET $new_values WHERE user_id = {$_POST['user_id']}";
}

function fileUploaded(string $file_post_name): bool
{
    return (file_exists($_FILES[$file_post_name]['tmp_name']) && is_uploaded_file($_FILES[$file_post_name]['tmp_name']));
}

function replace_photo(string $file_post_name, string $new_filename): void
{
    insert_pic_into_directory($_FILES[$file_post_name], $new_filename, pfp_directory_path);
}

/**
 * @throws Exception Emits Exception if error occurs.
 */
function edit_receptionist(): void
{
    if (!($_SERVER['REQUEST_METHOD'] == 'POST'))
        throw new RuntimeException("Form was not submitted correctly", 1);

    if (fileUploaded('user_pic')) replace_photo('user_pic', $_POST['email']);
    if (fileUploaded('national_id_photo')) replace_photo('national_id_photo', $_POST['email']);

    try
    {
        run_query(construct_edit_query_from_POST());
    } catch (Exception $e)
    {
        echo $e->getMessage();
        throw new RuntimeException("Failed to edit receptionist", 676, $e);
    }
}

$content = "Operation Successful.";
try
{
    edit_receptionist();
} catch (Exception $e)
{
    $content = $e->getMessage();
}
$index_url = REPOSITORY_PAGES_URL . "receptionists/";
echo construct_template("Edit receptionist", $content . "<a href='$index_url'>Back to table.</a>");
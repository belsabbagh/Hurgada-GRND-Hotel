<?php
include_once "../../global/php/db-functions.php";

/**
 * @throws Exception Emits Exception if error occurs.
 */
function edit_receptionist(): void
{
    if (!($_SERVER['REQUEST_METHOD'] == 'POST'))
        throw new RuntimeException("Form was not submitted correctly", 1);

    $query_constructor = function (string $attribute, bool $isString): string
    {
        $new = $isString ? "'$_POST[$attribute]'" : $_POST[$attribute];
        return "$attribute = $new";
    };

    $first_name = $query_constructor("first_name", true) . ", ";
    $last_name = $query_constructor("first_name", true) . ", ";
    $email = $query_constructor('email', true) . ", ";
    $user_type = $query_constructor('user_type', false) . ", ";
    $enabled = (array_key_exists('receptionist_enabled', $_POST) ? $query_constructor('receptionist_enabled', false) : "receptionist_enabled = 0") . ", ";
    $qc_comment = $query_constructor('receptionist_qc_comment', true);

    $new_values = $first_name . $last_name . $email . $user_type . $enabled . $qc_comment;

    $sql = "UPDATE users SET $new_values WHERE user_id = {$_POST['user_id']}";
    try
    {
        run_query($sql);
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
echo construct_template("Edit receptionist", $content . "<a href='http://localhost/Hurgada-GRND-Hotel/pages/receptionists/'>Back to table.</a>");
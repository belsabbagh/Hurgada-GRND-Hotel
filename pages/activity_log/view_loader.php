<?php
include_once "../../global/php/db-functions.php";
const DIRECTORY_PATH = "../../pages/receptionists";


/**
 * @author @Belal-Elsabbagh
 *
 * @return string
 */
function construct_log_table(): string
{
    $table = <<<TABLE
<table style="table-layout: fixed; width: 100%">
<tr><th>Time of Action</th><th>Action Owner ID</th><th>Action Type</th><th>Description</th><th>Transaction</th></tr>
TABLE;
    $log_data = run_query("SELECT * FROM activity_log;");
    while ($action = $log_data->fetch_assoc())
        $table .= construct_log_table_row($action);
    return $table . "</table>";
}

/**
 * @author @Belal-Elsabbagh
 *
 * @param array $action
 *
 * @return string
 */
function construct_log_table_row(array $action): string
{
    return /** @lang HTML */ <<<EOF
<tr>
    <td>{$action['timestamp']}</td>
    <td>{$action['owner']}</td>
    <td>{$action['actiontype']}</td>
    <td style="word-wrap: break-word">{$action['description']}</td>
    <td>{$action['transaction']}</td>
</tr>
EOF;
}
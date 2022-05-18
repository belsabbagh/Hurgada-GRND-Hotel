<?php
include_once "../../global/php/db-functions.php";
const DIRECTORY_PATH = "../../pages/receptionists";
const ID_PICS_DIR_PATH = "../../resources/img/id_pics/";
const PFP_DIR_PATH = "../../resources/img/user_pics/";

/**
 * @author @Belal-Elsabbagh
 *
 * @param mysqli_result $receptionists_data
 *
 * @return string
 */
function construct_receptionists_table(mysqli_result $receptionists_data): string
{
    $table = "<table><tr><th>Receptionist ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>View</th></tr>";
    while ($receptionist = $receptionists_data->fetch_assoc())
        $table .= construct_receptionist_table_row($receptionist);
    return $table . "</table>";
}

/**
 * @author @Belal-Elsabbagh
 *
 * @param array $receptionist
 *
 * @return string
 */
function construct_receptionist_table_row(array $receptionist): string
{
    $directory_url = DIRECTORY_PATH;
    $color = "";
    if ($receptionist["receptionist_enabled"] == 0) $color = "style='background-color: rgb(139, 146, 154);'";
    return "<tr $color>
                <td>{$receptionist['user_id']}</td>
                <td>{$receptionist['first_name']}</td>
                <td>{$receptionist['last_name']}</td>
                <td>{$receptionist['email']}</td>
                <td><a class='view-button' href='$directory_url/index.php?id={$receptionist["user_id"]}'><span class='td-link'>View</span></a></td>
            </tr>";
}

/**
 * @author @Belal-Elsabbagh
 *
 * @param array $receptionist
 * @param bool  $editable
 *
 * @return string
 */
function construct_receptionist_view(array $receptionist, bool $editable = false): string
{
    $readonly = $editable ? '' : "readonly";
    $disabled = $editable ? '' : "disabled";

    $id_pic_src = ID_PICS_DIR_PATH . $receptionist['national_id_photo'];
    $pfp_src = PFP_DIR_PATH . $receptionist['user_pic'];

    $save = $editable ? "<button type='submit' value='submit' name='submit' id='submit'>Save</button>" : "";

    $delete_page_url = DIRECTORY_PATH . "'/delete-receptionist.php?id={$receptionist['user_id']}'";
    $editing_form_url = DIRECTORY_PATH . "/index.php?id={$receptionist['user_id']}&editable";
    $delete_OR_edit = $editable ?
        "<a class='view-button' href='$delete_page_url'>Delete</a>"
        : "<a class='view-button' href='$editing_form_url'>Edit</a>";

    $checked = ($receptionist['receptionist_enabled'] == 1) ? "checked" : "";

    $pics = $editable ? "
        <div>
            <label for='user_pic'>Select profile picture:</label>
            <input type='file' name='user_pic' id='user_pic' accept='image/png, image/gif, image/jpeg' />
        </div>

        <div>
            <label for='national_id_photo'>Upload photo of national ID:</label>
            <input type='file' name='national_id_photo' id='national_id_photo' accept='image/png, image/gif, image/jpeg' />
        </div>"
        :
        "<div>
            Personal Photo
            <img src='$pfp_src' alt='profile picture' width='256px'>
        </div>

        <div>
            National ID
            <img src='$id_pic_src' alt='national id' width='256px'>
        </div>";

    return "<form action='edit-receptionist.php' method='post' id='receptionist_form' enctype='multipart/form-data'>
        <input type='hidden' name='user_id' value='{$receptionist['user_id']}' $readonly/>
        $pics
        <div>
            <label for='first_name'>First Name:</label>
            <input type='text' name='first_name' value='{$receptionist['first_name']}' $readonly/>
            <label for='last_name'>Last Name:</label>
            <input type='text' name='last_name' value='{$receptionist['last_name']}' $readonly/>
        </div>
        <div>
            <label for='email'>Email:</label>
            <input type='email' name='email' value='{$receptionist['email']}' $readonly/>
        </div>
        <div>
        <label for='user_type' >Employee Role:</label>
        <select name='user_type' id='user_type' $disabled>
            <option value='2' selected='selected'>Receptionist</option>
            <option value='1'>Quality Control Manager</option>
        </select>
        </div>
        <div>
            <label for='receptionist_enabled'>Enabled:</label>
            <input type='checkbox' name='receptionist_enabled' id='receptionist_enabled' value='1' $checked $disabled/>
            <br>
            <label for='receptionist_qc_comment'>Quality Control Comment:</label><br>
            <textarea name='receptionist_qc_comment' id='receptionist_qc_comment' rows='6' cols='30' placeholder='Enter comment' style='resize: none;' $readonly/>{$receptionist['receptionist_qc_comment']}</textarea>
        </div>
        $save
    </form>
    $delete_OR_edit";
}

function construct_new_receptionist_form(): string
{
    return "<form action='add-receptionist.php' method='post' id='form' enctype='multipart/form-data'>
        <div class='pfp'>
            <label for='user_pic'>Select profile picture:</label>
            <input type='file' name='user_pic' accept='image/png, image/gif, image/jpeg' required/>
        </div>

        <div class='id-pic'>
            <label for='national_id_photo'>Upload photo of national ID:</label>
            <input type='file' name='national_id_photo' accept='image/png, image/gif, image/jpeg, image/jpg' required/>
        </div>

        <div>
            <label for='first_name'>First Name:</label>
            <input type='text' name='first_name' required/>
            <label for='last_name'>Last Name:</label>
            <input type='text' name='last_name' required/>
        </div>
        <div>
            <label for='email'>Email:</label>
            <input type='email' name='email' required/>
            <label for='password'>Password:</label>
            <input type='password' name='password' required/>
        </div>
        <div>
            <label for='enabled'>Enabled:</label>
            <input type='checkbox' name='enabled' id='enabled' checked='checked'>
            <br>
            <label for='qc_comment'>Quality Control Comment (optional):</label><br>
            <textarea name='qc_comment' id='qc_comment' rows='6' cols='30' placeholder='Enter comment' style='resize: none;'></textarea>
        </div>
        <button type='submit' value='submit'>Add</button>
    </form>";
}


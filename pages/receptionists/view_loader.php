<?php
include_once "../../global/php/db-functions.php";
const directory_url = "http://localhost/Hurgada-GRND-Hotel/pages/receptionists";

function construct_receptionists_table(mysqli_result $receptionists_data): string
{
    $table = "<table><tr><th>Receptionist ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>View</th></tr>";
    while ($receptionist = $receptionists_data->fetch_assoc())
        $table .= construct_receptionist_table_row($receptionist);
    return $table . "</table>";
}

function construct_receptionist_table_row($receptionist): string
{
    $directory_url = directory_url;
    $color = "";
    if ($receptionist["receptionist_enabled"] == 0) $color = "style='background-color: rgb(139, 146, 154);'";
    return "<tr $color>
                <td>{$receptionist['user_id']}</td>
                <td>{$receptionist['first_name']}</td>
                <td>{$receptionist['last_name']}</td>
                <td>{$receptionist['email']}</td>
                <td><a class='view-button' href='$directory_url/view-receptionist.php?id={$receptionist["user_id"]}'><span class='td-link'>View</span></a></td>
            </tr>";
}

function construct_receptionist_view(array $receptionist): string
{
    return "<form action='' method='post' id='receptionist_form'>
        <div>
            <label for='user_pic'>Select profile picture:</label>
            <input type='file' name='user_pic' accept='image/png, image/gif, image/jpeg' />
        </div>

        <div>
            <label for='national_id_photo'>Upload photo of national ID:</label>
            <input type='file' name='national_id_photo' accept='image/png, image/gif, image/jpeg' />
        </div>

        <div>
            <label for='first_name'>First Name:</label>
            <input type='text' name='first_name' value='{$receptionist['first_name']}' readonly/>
            <label for='last_name'>Last Name:</label>
            <input type='text' name='last_name' value='{$receptionist['last_name']}' readonly/>
        </div>
        <div>
            <label for='email'>Email:</label>
            <input type='email' name='email' value='{$receptionist['email']}' readonly/>
        </div>
        <div>
            <label for='enabled'>Enabled:</label>
            <input type='checkbox' name='enabled' id='enabled' readonly/>
            <br>
            <label for='qc_comment'>Quality Control Comment:</label><br>
            <textarea name='qc_comment' id='qc_comment' rows='6' cols='30' placeholder='Enter comment' style='resize: none;' readonly/>{$receptionist['receptionist_qc_comment']}</textarea>
        </div>
        <button type='submit' hidden>Save</button>
    </form>
    <button onclick='enableEditing()'>Edit</button>";
}

function construct_new_receptionist_form(): string
{
    return "<form action='add-receptionist.php' method='post' id='form'>
        <div class='pfp'>
            <label for='user_pic'>Select profile picture:</label>
            <input type='file' name='user_pic' accept='image/png, image/gif, image/jpeg' required/>
        </div>

        <div class='id-pic' style=''>
            <label for='national_id_photo'>Upload photo of national ID:</label>
            <input type='file' name='national_id_photo' accept='image/png, image/gif, image/jpeg' required/>
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
        <button type='submit'>Add</button>
    </form>";
}
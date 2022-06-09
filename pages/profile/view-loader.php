<?php
include_once "../../global/php/db-functions.php";
const PROFILE_PATH = "../../pages/profile";
function load_user_view(array $current_user, bool $editable = false): string
{
    $readonly = $editable ? '' : "readonly";
    $disabled = $editable ? '' : "disabled";
    $password = $editable ? "<div class='pass'>
                                <label for='password'>Password:</label>
                                <p id='status_msg'></p>
                                <input type='password' name='password' id='password' value='{$current_user['password']}'/>
                            </div>" : "";

    //$id_pic_src = ID_PICS_DIR_PATH . $current_user['national_id_photo'];
    $pfp_src = PFP_DIRECTORY_PATH . $current_user['user_pic'];

    $save = $editable ? "<button type='submit' value='submit' name='submit' id='submit'>Save</button>" : "";

    $delete_page_url = PROFILE_PATH . "/delete-user.php?id={$current_user['user_id']}";
    $editing_form_url = PROFILE_PATH . "/index.php?id={$current_user['user_id']}&editable";
    $delete_OR_edit = $editable ?
        "<a class='view-button' href='$delete_page_url'>Delete</a>"
        : "<a class='view-button' href='$editing_form_url'>Edit</a>";

    $pics = $editable ? "
        <table class='table table-light table-hover'>
            <thead>
            <tr>
            <th scope='col'>user_pic</th>
            <th scope='col'>national_id_photo</th>
</tr>
</thead>
<tbody><tr>
<th scope='row'><div>
            <label for='user_pic'>Select profile picture:</label>
            <input type='file' name='user_pic' id='user_pic' accept='image/png, image/gif, image/jpeg' />
        </div></th>
        <th scope='row'><div>
            <label for='national_id_photo'>Upload photo of national ID:</label>
            <input type='file' name='national_id_photo' id='national_id_photo' accept='image/png, image/gif, image/jpeg' />
        </div></th>
        
</tr>
        </table></tbody> "
        :
        "<table class ='table table-hover table-light'>
<thead>
<tr>
<th scope='row'><div>
            Personal Photo
            <img src='$pfp_src' alt='profile picture' width='256px'>
        </div></th>
</tr>
</thead>
</table>";

    return "<form action='edit-user.php' method='post' id='user-form' enctype='multipart/form-data'>
        <input type='hidden' name='user_id' value='{$current_user['user_id']}' $readonly/>
        $pics
        <table class='table table-light table-hover' >
        <thead>
        <tr>
        <th scope='row'><div>
        <label for='first_name'>First Name:</label>
            <input type='text' name='first_name' value='{$current_user['first_name']}' $readonly/>
</div></th>
<th scope='row'><div>
<label for='last_name'>Last Name:</label>
            <input type='text' name='last_name' value='{$current_user['last_name']}' $readonly/>
</div></th>
<th scope='row'>
<div>
            <label for='email'>Email:</label>
            <p id='status_msg'></p>
            <input type='email' name='email' onkeyup='email_isDuplicate_msg(this.value, `status_msg`)' value='{$current_user['email']}' $readonly/>
        </div>
</th>
</tr>
</thead>
</table>

        
        $password
        $save
    </form>
    $delete_OR_edit";
}

function construct_dependants_table(mysqli_result $dependants_data): string
{
    $table = <<<TABLE
<table>
<tr><th>Name</th><th>Relationship</th><th>Child</th><th>View</th></tr>
TABLE;
    while ($dependant = $dependants_data->fetch_assoc())
        $table .= construct_dependant_table_row($dependant);
    return $table . "</table>";
}

/**
 * @param array $receptionist
 *
 * @return string
 * @author @Belal-Elsabbagh
 *
 */
function construct_dependant_table_row(array $dependant): string
{
    $isChild = ($dependant['child']) ? "yes" : "no";
    $view_href = PROFILE_PATH . "/dependants.php?id={$dependant["dependant_id"]}";
    return /** @lang HTML */ <<<EOF
<tr>
    <td>{$dependant['dependant_name']}</td>
    <td>{$dependant['relationship']}</td>
    <td>$isChild</td>
    <td><a class='view-button' href='$view_href'><span class='td-link'>View</span></a></td>
</tr>
EOF;
}

function load_dependant_view(array $current_dependant, bool $editable = false): string
{
    $checked = ($current_dependant['child'] == 1) ? "checked" : "";
    $readonly = $editable ? '' : "readonly";
    $disabled = $editable ? '' : "disabled";

    $save = $editable ? "<button type='submit' value='submit' name='submit' id='submit'>Save</button>" : "";

    $delete_page_url = PROFILE_PATH . "/delete-dependant.php?id={$current_dependant['dependant_id']}";
    $editing_form_url = PROFILE_PATH . "/dependants.php?id={$current_dependant['dependant_id']}&editable";
    $delete_OR_edit = $editable ?
        "<a class='view-button' href='$delete_page_url'>Delete</a>"
        : "<a class='view-button' href='$editing_form_url'>Edit</a>";

    $pics = $editable ? "
                <tr>
                    <th scope='col'>
                        <div>
                            <label for='identification'>identification:</label>
                            <input type='file' name='identification' id='identification'
                                   accept='image/png, image/gif, image/jpeg' required/>
                        </div>
                    </th>
                </tr>
                "
        :
        "";

    return "<form action='edit-dependant.php' method='post' id='dependant-form' enctype='multipart/form-data'>
        <input type='hidden' name='user_id' value='{$current_dependant['dependant_id']}' $readonly/>
        <table class='table table-light table-hover'>
            <thead>
            $pics
            <tr>
                <th scope='col'>
                    <div>
                        <label for='Dependant-name'>Dependant name:</label>
                        <input type='text' name='dependant_name' id='dependant-name' value='{$current_dependant['dependant_name']}' $readonly required/>
                    </div>
                </th>
            </tr>
            <tr>
                <th scope='col'>
                    <div>
                        <label for='relationship'>Relationship:</label>
                        <input type='text' name='relationship' id='relationship' value='{$current_dependant['relationship']}' $readonly required/>
                    </div>
                </th>
            </tr>
            <tr>
                <th scope='col'>
                    <div>
                        <label for='child'>Is child:</label>
                        <input type='checkbox' name='isChild' id='isChild' $disabled $checked required/>
                    </div>
                </th>
            </tr>
            </thead>
        </table>
        $save
    </form>
    $delete_OR_edit";
}

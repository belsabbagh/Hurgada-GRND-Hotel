<?php
include_once "../../global/php/db-functions.php";
include_once "view-loader.php";
maintain_session();
redirect_to_login();

function add_new_dependant(): void
{
    if (!post_data_exists()) throw new ErrorException("Form was not submitted correctly", 1);

    $idp_file_name = insert_pic_into_directory($_FILES['national_id_photo'], ID_PIC_DIRECTORY_PATH);
    $parent_id = get_active_user_id();
    $sql = "INSERT INTO dependants (dependent_name, relationship,identification, child, parent_id) 
            VALUES ('{$_POST['dependant_name']}', '{$_POST['relationship']}', '{$_POST['identification']}', '{$_POST['child']}', '$idp_file_name', $parent_id)";
    try {
        run_query($sql);
    } catch (mysqli_sql_exception $e) {
        echo $e->getMessage();
        throw new RuntimeException("Failed to add new Receptionist.", 686, $e);
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>profile page</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css-profile.css">
    <!-- Custom Javascript -->
    <script src="profile.js"></script>
    <script src="../../global/js/ajax_functions.js"></script>

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
            integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
            crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
            integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
            crossorigin="anonymous"></script>
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
</head>

<body>
<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
<!-- jQuery Custom Scroller CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

<div class="main">
    <form action="add-dependant.php" method="post" enctype='multipart/form-data'>
        <table class='table table-light table-hover'>
            <thead>
            <tr>
                <th scope='col'>
                    <div>
                        <label for='Dependant-name'>Dependant name:</label>
                        <input type='text' name='dependant_name' id='dependant-name' required/>
                    </div>
                </th>
            </tr>
            <tr>
                <th scope='col'>
                    <div>
                        <label for='relationship'>Relationship:</label>
                        <input type='text' name='relationship' id='relationship' required/>
                    </div>
                </th>
            </tr>
            <tr>
                <th scope='col'>
                    <div>
                        <label for='identification'>identification:</label>
                        <input type='file' name='identification' id='identification'
                               accept='image/png, image/gif, image/jpeg' required/>
                    </div>
                </th>
            </tr>
            <tr>
                <th scope='col'>
                    <div>
                        <label for='child'>Is child:</label>
                        <input type='checkbox' name='isChild' id='isChild' required/>
                    </div>
                </th>
            </tr>
            <tr>
                <th scope='col'>
                    <div>
                        <input type='submit' name='Add' id='add'/>
                    </div>
                </th>
            </tr>
            </thead>
        </table>
    </form>
</div>

<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar" class="sidebar" class="navbar navbar-light" style="background-color: #e3f2fd;">
        <ul class="list-unstyled components">
            <?php
            include_once "../../global/php/db-functions.php";
            echo load_profile_navbar(get_active_user_type());
            ?>
        </ul>
    </nav>
</div>
</body>

</html>


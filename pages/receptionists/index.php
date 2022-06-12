<?php
include_once "../../global/php/db-functions.php";
include_once "view_loader.php";
maintain_session();
//redirect_to_login();
//restrict_to_staff();
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>HURGADA-GRND-HOTEL</title>
    <link rel="icon" href="../../resources/img/pretty stuff/hurghada-beach.jpg">
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- Main template CSS File -->
    <link rel='stylesheet' href='../../global/template/qualitytemp.css' />
    <link rel='stylesheet' href='./style.css' />
    <!-- Main JS File -->
    <script src='../../global/template/template.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="../../global/js/ajax_functions.js"></script>
    <!-- Render All Alements Normally -->
    <link rel="stylesheet" href="../../global/template/normalize.css" />
    <script>
        function search() {
            $.ajax({
                url: "search.php",
                data: "key=" + $("#searchKey").val() + "&" + "property=" + $("#property").val(),
                type: "POST",
                success: function(data) {
                    $("#receptionists-table").html(data)
                }
            });
        }
    </script>
</head>

<body>
    <!--=============== Side Bar ===============-->
    <div class="sidebar">
        <ul>
            <li>
                <a href="./view.php">
                    <i class='bx bxs-user-rectangle'></i> Profile</a>
            </li>
            <li>
                <a href="../viewcomments/view.php">
                    <i class='bx bxs-message-dots'></i> Guests Comments</a>
            </li>
            <li>
                <a href="./view.php">
                    <i class='bx bxs-report'></i> Rating Reports</a>
            </li>
            <li>
                <a href="../recepyionists/index.php">
                    <i class='bx bxs-edit-alt'></i> Receptionist</a>
            </li>
            <li>
                <a href="./view.php">
                    <i class='bx bx-log-out'></i> Log out</a>
            </li>
        </ul>
    </div>
    <!--=============== End Of Side Bar ===============-->


    <!--=============== Body ===============-->

    <div class='container-fluid root'>
        <div class="row container-fluid">
            <div class='feature'>
                <form>
                    <label for="searchKey">Search for:</label><input type="text" id="searchKey" name="searchKey" onchange="search()">
                    <label for="property">Search by:</label><select id="property">
                        <option value="user_id">ID</option>
                        <optgroup label="Name">
                            <option value="first_name">First Name</option>
                            <option value="last_name">Last Name</option>
                        </optgroup>
                        <option value="email">Email</option>
                    </select>
                </form>
            </div>
            <div class='feature' id="receptionists-table">
                <?php
                if (array_key_exists('id', $_GET)) {
                    echo construct_receptionist_view(get_user_by_id($_GET["id"]), array_key_exists('editable', $_GET));
                    return;
                }
                try {
                    $data = get_receptionists();
                    echo construct_receptionists_table($data) . "<a class='view-button' href='http://localhost/Hurgada-GRND-Hotel/pages/receptionists/new-receptionist.php'>Add New Receptionist</a>";
                } catch (Exception $e) {
                    echo "<p>" . $e->getMessage() . "</p>";
                }
                ?>
            </div>
        </div>
    </div>
    <!--=============== Body ===============-->


    <!--=============== End Of Body ===============-->
</body>

</html>
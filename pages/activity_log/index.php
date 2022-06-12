<?php
include_once "../../global/php/db-functions.php";
include_once "view_loader.php";
maintain_session();
//redirect_to_login();
//restrict_to_staff();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HURGADA-GRND-HOTEL</title>
    <link rel="icon" href="../../resources/img/pretty stuff/hurghada-beach.jpg">
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='../../global/css/bootstrap-5.0.2-dist/css/bootstrap.css'>
    <script src='../../global/css/bootstrap-5.0.2-dist/js/bootstrap.js'></script>
    <script src='../../global/js/font-awesome.js'></script>
    <!-- Main template CSS File -->
    <link rel='stylesheet' href='../../global/template/template.css'/>
    <link rel='stylesheet' href='./style.css'/>
    <!-- Main JS File -->
    <script src='../../global/template/template.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="../../global/js/ajax_functions.js"></script>
    <link rel='stylesheet' href='../../global/template/qualitytemp.css'/>
</head>

<body class='d-flex flex-column min-vh-100'>
<!--=============== Header ===============-->
<div class="sidebar">
    <ul>
        <?php echo load_navbar(1) ?>
    </ul>
</div>
<!--=============== End Of Header ===============-->


<!--=============== Body ===============-->

<div class="features">
    <div class='container root'>
        <div class='feature' id="receptionists-table">
            <?php
            try
            {
                echo construct_log_table();
            } catch (Exception $e)
            {
                echo "<p>" . $e->getMessage() . "</p>";
            }
            ?>
        </div>
    </div>
</div>
<!--=============== End Of Body ===============-->
</body>

</html>
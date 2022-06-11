<?php
include_once "../../global/php/db-functions.php";
include_once "form_loader.php";
maintain_session();
redirect_to_login();
$user_type = get_active_user_type();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='../../global/css/bootstrap-5.0.2-dist/css/bootstrap.css'>
    <script src='../../global/css/bootstrap-5.0.2-dist/js/bootstrap.js'></script>
    <script src='../../global/js/font-awesome.js'></script>
    <!-- Render All Alements Normally -->
    <link rel="stylesheet" href="../../global/template/normalize.css"/>
    <!-- Main template CSS File -->
    <link rel='stylesheet' href='../../global/css/style.css'/>
    <link rel='stylesheet' href='../../global/template/template.css'/>
    <link rel='stylesheet' href='./style.css'/>
    <link rel='stylesheet' href='../../global/template/receptionist_temp.css'/>
    <!-- Main JS File -->
    <script src='../../global/template/template.js'></script>
</head>

<body>
<!--=============== Header ===============-->
<?php echo (user_type_isEmployee($user_type)) ? "<div class='sidebar'><ul>" . load_navbar($user_type) . "</ul></div>" : load_client_nav(); ?>
<!--=============== End Of Header ===============-->


<!--=============== Body ===============-->

<div class="features">
    <div class='container root'>
        <div class='feature'>
            <?php echo construct_new_booking_form($user_type); ?>
        </div>
    </div>
</div>
<!--=============== End Of Body ===============-->


<!--=============== Footer ===============-->
<footer class='footer'>
    <div class='container p-4 pb-0'>
        <!-- Section: Social media -->
            <section class='github'>
                <!-- Github -->
                <a href='https://github.com/Belal-Elsabbagh/Hurgada-GRND-Hotel' role='button'>
                    <img src='../../resources/img/icons/GitHub-Mark-Light-64px.png' width='32' alt='Our GitHub'> GitHub Repository
                </a>
            </section>
        </div>
        <!-- Section: Social media -->
        <!-- Copyright -->
        <div class='copyright'>
            &copy; 2022
            <span>MIU</span> All Rights Reserved
        </div>
        <!-- Copyright -->
    </footer>
    <span class="c-scroller_thumb"></span>
    <!--=============== End Of Footer ===============-->
</body>

</html>
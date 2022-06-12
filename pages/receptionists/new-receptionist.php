<?php
include_once "../../global/php/db-functions.php";
maintain_session();
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
    <link rel='stylesheet' href='../../global/css/bootstrap-5.0.2-dist/css/bootstrap.css'>
    <script src='../../global/css/bootstrap-5.0.2-dist/js/bootstrap.js'></script>
    <script src='../../global/js/font-awesome.js'></script>
    <link rel='stylesheet' href='../../global/css/style.css'/>
    <link rel='stylesheet' href='style.css'/>
    <!-- Main template CSS File -->
    <link rel='stylesheet' href='../../global/template/template-bootstrap.css'/>
    <!-- Main JS File -->
    <script src='../../global/template/template.js'></script>
    <script src="../../global/js/ajax_functions.js"></script>
    <link rel='stylesheet' href='../../global/template/qualitytemp.css'/>
</head>

<body class='d-flex flex-column min-vh-100'>
<!-- Header -->
<div class="sidebar">
    <ul>
        <?php echo load_navbar(1) ?>
    </ul>
</div>
<!-- End Of Header -->

<!-- Body -->

<div class='container root'>
    <div class='feature'>
        <form action='add-receptionist.php' method='post' id='form' enctype='multipart/form-data'>
            <div class='pfp'>
                <label for='user_pic'>Select profile picture:</label>
                <input type='file' class='form-control' name='user_pic' accept='image/png, image/gif, image/jpeg' required/>
            </div>

            <div class='id-pic'>
                <label for='national_id_photo'>Upload photo of national ID:</label>
                <input type='file' class='form-control' name='national_id_photo' accept='image/png, image/gif, image/jpeg, image/jpg' required/>
            </div>

            <div>
                <label for='first_name'>First Name:</label>
                <input type='text' class='form-control' name='first_name' id='first_name' required/>
                <label for='last_name'>Last Name:</label>
                <input type='text' class='form-control' name='last_name' id='last_name' required/>
            </div>
            <div>
                <label for='email'>Email:</label>
                <p id="status_msg"></p>
                <input type='email' class='form-control' name='email' id='email' onkeyup="email_isDuplicate_msg(this.value, 'status_msg')" required/>
                <label for='password'>Password:</label>
                <input type='password' class='form-control' name='password' id="password" required/>
            </div>
            <div>
                <div>
                    <label for='enabled'>Enabled:</label>
                    <input type='checkbox' name='enabled' id='enabled' checked='checked'>
                </div>
                <label for='qc_comment'>Quality Control Comment (optional):</label><br>
                <textarea name='qc_comment' class='form-control' id='qc_comment' rows='6' cols='30' placeholder='Enter comment' style='resize: none;'></textarea>
            </div>
            <button type='submit' id='submit' value='submit'>Add</button>
        </form>
    </div>
</div>
<!-- End Of Body -->


<!-- Footer -->
<footer class='text-center text-white mt-auto' style='background-color: var(--blue0-color);'>
    <!-- Grid container -->
    <div class='container p-4 pb-0'>
        <!-- Section: Social media -->
        <section class='mb-4'>
            <!-- Github -->
            <a class='btn btn-outline-light btn-floating m-1'
               href='https://github.com/Belal-Elsabbagh/Hurgada-GRND-Hotel' role='button'>
                <img src='../../resources/img/icons/GitHub-Mark-Light-64px.png' width='32' alt='Our GitHub'> GitHub
                Repository
            </a>
        </section>
        <!-- Section: Social media -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class='text-center p-3' style='background-color: var(--blue0-color);'>
        &copy; 2022
        <span>MIU</span> All Rights Reserved
    </div>
    <!-- Copyright -->
</footer>
<!-- End Of Footer -->

<!-- Scroll Bar -->
<span class='c-scroller_thumb'></span>
</body>

</html>
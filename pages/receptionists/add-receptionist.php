<?php
const pfp_directory_path = "../../resources/img/user_pics/";
const id_pic_directory_path = "../../resources/img/id_pics/";

/**
 * Takes a submitted picture, renames it to the user's email, and moves it to the given directory to be stored.
 *
 * @author @Belal-Elsabbagh
 *
 * @param array  $pic           The submitted picture
 * @param string $new_filename  The desired file name.
 * @param string $directory     The folder where the file will go
 *
 * @var string   $pic_extension The picture's extension.
 * @var string   $pic_filename  The full new image file name.
 * @return string The full new image file name.
 */
function insert_pic_into_directory(array $pic, string $new_filename, string $directory): string
{
    $pic_info = pathinfo($pic['name']);
    $pic_extension = $pic_info['extension'];
    $pic_filename = $new_filename . '.' . $pic_extension;
    move_uploaded_file($pic['tmp_name'], $directory . $pic_filename);
    return $pic_filename;
}

/**
 * @author @Belal-Elsabbagh
 *
 * @throws Exception Emits Exception in case of an error.
 */
function add_new_receptionist(): void
{
    if (!($_SERVER['REQUEST_METHOD'] == 'POST')) throw new ErrorException("Form was not submitted correctly", 1);
    $enabled = array_key_exists('enabled', $_POST) ? 1 : 0;

    $pfp_file_name = insert_pic_into_directory($_FILES['user_pic'], $_POST['email'], pfp_directory_path);
    $idp_file_name = insert_pic_into_directory($_FILES['national_id_photo'], $_POST['email'], id_pic_directory_path);

    $sql = "INSERT INTO users (email, first_name, last_name, password, national_id_photo, user_pic, user_type, receptionist_enabled, receptionist_qc_comment) 
            VALUES ('{$_POST['email']}', '{$_POST['first_name']}', '{$_POST['last_name']}', '{$_POST['password']}', '$idp_file_name', '$pfp_file_name', 2, $enabled, '{$_POST['qc_comment']}')";
    try
    {
        run_query($sql);
    } catch (mysqli_sql_exception $e)
    {
        echo $e->getMessage();
        throw new RuntimeException("Failed to add new Receptionist.", 686, $e);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../global/css/style.css">
    <link rel="stylesheet" href="style.css">
    <title>Booking</title>
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- Main JS File -->
    <script src="../../global/template/template.js"></script>
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="../../global/template/normalize.css"/>
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="../../global/template/template.css"/>
    <script>
        const params = new URLSearchParams(window.location.search);
        if (params.has("err")) alert(params.get('err'));
    </script>
</head>

<body>
<!-- Header -->
<div class="header" id="header">
    <div class="container">
        <div class="links">
                <span id="icon" class="icon" onclick="showbar()">
                    <em class='bx bx-menu-alt-left'></em>
                </span>
            <div class="items" id="items">
                    <span class="container">
                        <span>Home</span>
                    </span>
                <span class="container">
                        <span>Rooms</span>
                    </span>
                <span class="container">
                        <span>Dining</span>
                    </span>
                <span class="container">
                        <span>Experience</span>
                    </span>
                <span class="container">
                        <span>Location</span>
                    </span>
                <span class="container">
                        <span>About</span>
                    </span>
            </div>
            <span id='icon2' class="icon2" onclick="hidebar()">
                    <em class='bx bx-x'></em>
                </span>
            <em class='book' id="book">Book now</em>
            <ul id="bar">
                <li><a href="http://localhost/Hurgada-GRND-Hotel/pages/profile"><em class='bx bxs-user'></em>Profile</a>
                </li>
                <li><a href="http://localhost/Hurgada-GRND-Hotel/pages/reservation"><em class='bx bxs-bed'></em> My
                        Reservations</a></li>
                <li><a href="http://localhost/Hurgada-GRND-Hotel/pages/rate-us"><em class='bx bxs-star'></em> Rate
                        us</a></li>
                <li><a href="http://localhost/Hurgada-GRND-Hotel/pages/contact-us"><em class='bx bxl-gmail'></em>Contact
                        us</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- End Of Header -->

<!-- Body -->
<div class="features">
    <div class="container">
        <div class="feat" style="margin: auto;">
            <?php
            include_once "view_loader.php";
            try
            {
                add_new_receptionist();
            } catch (Exception $e)
            {
                echo "<p>" . $e->getMessage() . "</p>";
            }
            ?>
        </div>
    </div>
</div>
<!-- End Of Body -->


<!-- Footer -->
<div class="footer">
    &copy; 2022
    <span>MIU</span>
    All Rights Reserved
</div>
<!-- End Of Footer -->

<!-- Scroll Bar -->
<span class="c-scroller_thumb"></span>
</body>

</html>

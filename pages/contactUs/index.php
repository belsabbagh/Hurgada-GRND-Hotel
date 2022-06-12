<!DOCTYPE html>
<?php
include_once "../../global/php/db-functions.php";
maintain_session();
//redirect_to_login();
$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
?>

<html lang="en">

<head>
    <title>HURGADA-GRND-HOTEL</title>
    <link rel="icon" href="../../resources/img/pretty stuff/hurghada-beach.jpg">
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="../../global/template/template.css" />
    <link rel="stylesheet" href="./contactus.css" />
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- Main JS File -->
    <script src="../../global/Template/template.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS library -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- JavaScript library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <!-- Latest compiled JavaScript library -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</head>

<body>
    <!--=============== Header ===============-->
    <div class="header" id="header">
        <div class="container">
            <div class="links">
                <span id="icon" class="icon" onclick="showbar()">
                    <i class='bx bx-menu-alt-left'></i>
                </span>
                <div class="items" id="items">
                    <span class="container">
                        <span><a href="../HomePage/index.php#home">Home</a></span>
                    </span>
                    <span class="container">
                        <span><a href="../HomePage/index.php#rooms">Rooms</a></span>
                    </span>
                    <span class="container">
                        <span><a href="../HomePage/index.php#dine">Dining</a></span>
                    </span>
                    <span class="container">
                        <span><a href="../HomePage/index.php#exp">Experience</a></span>
                    </span>
                    <span class="container">
                        <span><a href="../HomePage/index.php#loc">Location</a></span>
                    </span>
                    <span class="container">
                        <span><a href="../HomePage/index.php#about">About</a></span>
                    </span>
                </div>
                <span id='icon2' class="icon2" onclick="hidebar()">
                    <i class='bx bx-x'></i>
                </span>
                <i class='book' id="book"><a href="../booking/index.php">Book now</a></i>
                <ul id="bar">
                    <?php include_once "../../global/php/db-functions.php";
                    echo load_navbar(get_active_user_type()); ?>
                </ul>
            </div>
        </div>
    </div>
    <!--=============== End Of Header ===============-->


    <!--=============== Body ===============-->
    <div class="features">
        <div class="container">
            <div class="container text-center">
                <h1 class="text">Contact Us</h1>
                <p>we're open every day 24/7, and you're most welcomed to leave your suggestions below </p>
            </div>

            <div align="center">
                <form id="form_contactUs">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">your suggestion</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-outline-primary btn-lg">submit</button>
                    </div>
                </form>
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
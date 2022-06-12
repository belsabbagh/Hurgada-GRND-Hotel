<?php
include_once "../../global/php/db-functions.php";
maintain_session();
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
    <title>signUp page</title>
    <link rel="stylesheet" href="signUp.css">
    <link rel="stylesheet" href="../../global/template/template.css" >
    <script src="../../global/js/jquery-3.6.0.min.js"></script>
    <script src="../../global/js/ajax_functions.js"></script>
    <script src="signUp.js"></script>
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
    <!-- Main JS File -->
    <script src="../../global/template/template.js"></script>
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="../../global/template/normalize.css" />

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
            <div class="feat">
                <form action="SignUp.php" method="post" enctype='multipart/form-data' style="text-align:center;">
                    <!--to center the form
                        "border:1px solid #ccc" for border -->
                    <div class="container">
                        <h1>Sign Up</h1>
                        <p>Please fill in this form to create an account in our hotel's system.</p>
                        <hr>

                        <div class='pfp'>
                            <label for='user_pic'>Select profile picture:</label>
                            <input type='file' name='user_pic' accept='image/png, image/gif, image/jpeg' required />
                        </div>

                        <div class='id-pic'>
                            <label for='national_id_photo'>Upload photo of national ID:</label>
                            <input type='file' name='national_id_photo' accept='image/png, image/gif, image/jpeg, image/jpg' required />
                        </div>

                        <div>
                            <label for='first_name'>First Name:</label>
                            <input type='text' name='first_name' required />
                            <label for='last_name'>Last Name:</label>
                            <input type='text' name='last_name' required />
                        </div>

                        <label for="email"><b>Email</b></label>
                        <input type="email" class="form-control" placeholder="enter your Email" name="email" onkeyup="email_isDuplicate_msg(this.value, 'status-msg')" required>
                        <p id="status-msg"></p>

                        <label for="password"><b>Password</b></label>
                        <input type="password" placeholder="enter your Password" name="password" required>

                        <label for="psw-repeat"><b>Repeat Password</b></label>
                        <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

                        <label>
                            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
                        </label>

                        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

                        <div class="clearfix">
                            <button type="submit" class="signupbtn" formmethod="post">Sign Up</button>
                            <button type="button" class="cancelbtn">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
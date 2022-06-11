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
    <title>HURGHADA-GRND-HOTEL</title>
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- Main JS File -->
    <script src="./login.js"></script>
    <!-- Render All Alements Normally -->
    <link rel="stylesheet" href="../../global/template/normalize.css" />
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="./login.css" />
    <link rel="stylesheet" href="../../global/template/template.css" />
    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <!-- For the icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <!--=============== Header ===============-->
    <a name="home"></a>
    <div class="header" id="header">
        <div class="container">
            <div class="links">
                    <span id="icon" class="icon" onclick="showbar()">
                        <i class='bx bx-menu-alt-left'></i>
                    </span>
                <span id='icon2' class="icon2" onclick="hidebar()">
                    <i class='bx bx-x'></i>
                </span>
                <i class='book' id="book"><a href="../booking/index.php">Book now</a></i>
                <ul id="bar">
                    <li><a href="../HomePage/index.php#home"><i class='bx bxs-home-alt-2'></i> Home</a></span></li>
                    <li><a href="../signUp/index.php"><i class='bx bxs-home-alt-2'></i> Sign Up</a></span></li>
                </ul>
            </div>
        </div>
    </div>
    <!--=============== End Of Header ===============-->


    <!--=============== Body ===============-->
    <section class="video">
    <video id='vid' src="../../resources/videos/sea and rocks.mp4" muted loop autoplay></video>
    </section>
    <form method="post" action="login.php">
        <div class="features">
            <div class="container">
                <div class="content">
                    <div class="title">
                        <h2>Login</h2>
                    </div>
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">
                                <h3>Email</h3>
                            </span>
                            <div class="input-icons">
                                <i class="fa fa-envelope icon"></i>
                                <input class="inpt" type="email" name='email' placeholder="Enter your email" required onkeyup="emailCheck(this.value)">
                            </div>
                        </div>
                    </div>
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">
                                <h3>Password</h3>
                            </span>
                            <div class="input-icons">
                                <i class="fa fa-key icon"></i>
                                <input class="inpt" type="password" name='password' placeholder="Enter your password" required>
                            </div>
                        </div>
                    </div>
                    <div class="button">
                        <input type="submit" value="Login">
                    </div>
                    <p id="form-message"></p>
                    <hr class="line">
                    <p class = 'link'>Don't have an account? <a href="../signUp/index.php"> Sign up!</a></p>
                </div>
            </div>
        </div>
    </form>
    <!--=============== End Of Body ===============-->


    <!--=============== Footer ===============-->
    <span class="c-scroller_thumb"></span>
    <!--=============== End Of Footer ===============-->
</body>

</html>
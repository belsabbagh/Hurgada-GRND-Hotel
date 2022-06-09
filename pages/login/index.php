<?php include_once "../../global/php/db-functions.php";
maintain_session(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HURGADA-GRND-HOTEL</title>
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- Main JS File -->
    <script src="template.js"></script>
    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <!-- Render All Alements Normally -->
    <link rel="stylesheet" href="./normalize.css"/>
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="./login+template.css"/>
    <script type="text/javascript">
        function emailCheck(email) {
            var r = new XMLHttpRequest();
            r.open("post", "check.php?email=" + email, true);
            r.send();
            r.onreadystatechange = function () {
                if (r.readyState == 4 && r.status == 200) {
                    document.getElementById("message").innerHTML = email + " " + r.responseText;
                }
            }
        }
    </script>
    <!-- For the icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/fontawesome.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"
    />
</head>

<body>
<!-- Header -->
<div class="header" id="header">
    <div class="container">
        <div class="links">
                <span id="icon" class="icon" onclick="showbar()">
                    <i class='bx bx-menu-alt-left'></i>
                </span>
            <div class="items" id="items">
                <?php echo load_header_bar(get_active_user_type()); ?>
            </div>
            <span id='icon2' class="icon2" onclick="hidebar()">
                    <i class='bx bx-x'></i>
                </span>
            <i class='book' id="book">Book now</i>
            <ul id="bar">
                <li><a href="Profile"><i class='bx bxs-user'></i> Profile</a></li>
                <li><a href="MyReservations"><i class='bx bxs-bed'></i> My Reservations</a></li>
                <li><a href="RateUs"><i class='bx bxs-star'></i> Rate us</a></li>
                <li><a href="ContacUs"><i class='bx bxl-gmail'></i> Contact us</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- End Of Header -->

<!-- Body -->


<form method="post" action="login.php">
    <div class="video">
        <video height="1000" src="../../resources/videos/sea and rocks.mp4" muted loop autoplay></video>
    </div>
    <div class="features">
        <div class="container">
            <div class="content">
                <div class="title">
                    <h2>Login</h2>
                </div>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details"><h3>Email</h3></span>
                        <div class="input-icons">
                            <i class="fa fa-envelope icon"></i>
                            <input class="inpt" type="email" name='email' placeholder="Enter your email" required
                                   onkeyup="emailCheck(this.value)">
                        </div>
                    </div>
                </div>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details"><h3>Password</h3></span>
                        <div class="input-icons">
                            <i class="fa fa-key icon"></i>
                            <input class="inpt" type="password" name='password' placeholder="Enter your password"
                                   required>
                            <!-- <div class="data">
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Login">
                </div>
                <p id="form-message"></p>
                <hr class="line">
                <p>Don't have an account? <a href="<?php echo REPOSITORY_PAGES_URL . "signUp/index.php" ?>"> Sign
                        up!</a></p>
            </div>
        </div>
        <!-- <hr style="width:50%;text-align:left;margin-left:0"> -->
    </div>
</form>

<!-- End Of Body -->


<!-- Footer -->
<!-- <div class="footer">
    &copy; 2022
    <span>MIU</span> All Rights Reserved
</div> -->
<!-- End Of Footer -->

<!-- Scroll Bar -->
<span class="c-scroller_thumb"></span>
</body>

</html>
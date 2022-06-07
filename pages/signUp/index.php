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
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>signUp page</title>
    <link rel="stylesheet" href="signUp.css">
    <script src="../../global/js/jquery-3.6.0.min.js"></script>
    <script src="../../global/js/ajax_functions.js"></script>
    <script src="signUp.js"></script>
    <!-- Bootstrap CSS library -->
    <link rel="stylesheet" href=
    "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity=
          "sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity=
            "sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous">
    </script>

    <!-- JavaScript library -->
    <script src=
            "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity=
            "sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous">
    </script>

    <!-- Latest compiled JavaScript library -->
    <script src=
            "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity=
            "sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous">
    </script>

    <!-- Main JS File -->
    <script src="../../global/template/template.js"></script>
    <!-- Render All Elements Normally -->
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="../../global/template/normalize.css"/>
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="../../global/template/template-bootstrap.css"/>
    <link rel="stylesheet" href="../../global/css/style.css">

</head>

<body>
<!-- Header -->
<nav class='navbar' id='header'>
    <div class='container-fluid'>
        <div class='navbar-header' onclick='showbar()'>
            <span class='navbar-brand'><em class='bx bx-menu-alt-left icon'></em></span>
        </div>
        <div class='row'>
            <ul class='nav items' id='items'>
                <?php echo load_header_bar(get_active_user_type(), true); ?>
            </ul>
        </div>
        <div class="">
            <span id='icon2' class='icon2' onclick='hidebar()'><em class='bx bx-x'></em></span>
        </div>
        <span class='book nav navbar-nav navbar-right nav-link-container text-center' id='book'><a
                    class='nav-link nlink' href='#'>Book now</a></span>
    </div>
</nav>
<!-- End Of Header -->

<!-- Body -->


<div class="features">
    <div class="container">
        <div class="feat">
            <form action="SignUp.php" method="post" enctype='multipart/form-data' style="text-align:center;"> <!--to center the form
                        "border:1px solid #ccc" for border -->
                <div class="container">
                    <h1>Sign Up</h1>
                    <p>Please fill in this form to create an account in our hotel's system.</p>
                    <hr>

                    <div class='pfp'>
                        <label for='user_pic'>Select profile picture:</label>
                        <input type='file' name='user_pic' accept='image/png, image/gif, image/jpeg' required/>
                    </div>

                    <div class='id-pic'>
                        <label for='national_id_photo'>Upload photo of national ID:</label>
                        <input type='file' name='national_id_photo' accept='image/png, image/gif, image/jpeg, image/jpg' required/>
                    </div>

                    <div>
                        <label for='first_name'>First Name:</label>
                        <input type='text' name='first_name' required/>
                        <label for='last_name'>Last Name:</label>
                        <input type='text' name='last_name' required/>
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
                        <button type="button" class="cancelbtn">Cancel</button>
                        <button type="submit" class="signupbtn" formmethod="post">Sign Up</button>
                    </div>
                </div>
            </form>
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
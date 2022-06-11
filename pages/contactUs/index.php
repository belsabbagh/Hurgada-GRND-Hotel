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
    <title>ContactUs page</title>
    <meta charset="utf-8">
    <meta name="viewport" content=
        "width=device-width, initial-scale=1">
 
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
</head>

<body>
<div class="container text-center">
    <h1 class="text">Contact Us</h1>
    <p>we're open every day 24/7, and you're most welcomed to leave your suggestions below </p>
</div>

<style>
    h1.text {
        color: #f6bca1;

    }
</style>

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
        <style>
            #text-fixed{
                max-width:150px;
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
            }
        </style>
        <div class="col-6">
            <button type="submit" class="btn btn-outline-primary btn-lg">submit</button>
        </div>
    </form>
</div>
<style>
    label {
        color: #b53e07
    }

    button.btn-outline-primary {
        color: #f6bca1;
    }

</style>
<style>
    /*so that the size of page
    doesn't change from one device to other*/
    *{
        vertical-align: baseline
    ;
        font-weight: inherit
    ;
        font-family: inherit
    ;
        font-size: 100%
    ;
        border: 0
    ;
        outline: 0
    ;
        padding: 0
    ;
        margin: 0
    ;
    }
</style>
</body>
</html> 

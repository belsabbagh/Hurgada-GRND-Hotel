<html>

<head>
    <link href="../../global/css/style.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="functions.js"></script>
    <title> rate us </title>
    <?php
    
    include_once "../../global/php/db-functions.php";
    maintain_session();
    //redirect_to_login();

    ?>
    <style>
        .shadow {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            height: 550px;
            padding-top: 15%;
            border-radius: 30px;
            width: 210%;
            color: #7b5c52;


        }

        .row {
            padding-top: 80px;
            padding-right: 50%;
            font-size: larger;
            margin-right: 70%;

        }

        .submit_rating {
            padding-top: 10%;
            margin-bottom: 45%;
            margin-right: 50%;
            margin-left: 30%;
            padding-left: 15%;
        }

        label {
            float: left;
        }
    </style>


    <link href="../../global/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./reservation_css.css" />
    <script src="../../global/Template/template.js"></script>
    <link href="style.css" rel="stylesheet">
    <script src="functions.js"></script>

    <?php $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hurgada-grnd-hotel";

    $connect = new mysqli($server, $username, $password, $dbname); ?>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HURGHADA-GRND-HOTEL</title>
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- Main JS File -->
    <script src="template.js"></script>
    <!-- Render All Alements Normally -->
    <link rel="stylesheet" href="./normalize.css" />
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="./template.css" />



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
                <i class='book' id="book"><a href="<?php echo REPOSITORY_PAGES_URL . "booking" ?>">Book now</a></i>
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




    <?php
    if (isset($_GET['id']))
        $reservation_id = $_GET['id'];
    else echo "error";
    //$client_ID='$_SESSION['active_id']';
    $client_ID = '1';
    // make a skip rating option 
    ?>
</head>

<body>
    <!-- Body -->
    <div class="features">
        <div class="container2">
            <div class="feat">
                <div class="row col-md-12">
                    <div class="shadow col-md-6 mt-5 ">
                        <h2 class="titles"> rate us! </h2>
                        <form action="" method="post">
                            <label for="over all rating">over all rating </label>
                            <div class="slidecontainer  ">


                                <input type="range" min="1" max="100" value="50" class="slider" id="overall" oninput="rangevalue.value=value">
                                <output id="rangevalue">50</output>
                            </div>

                            <label for="view rating"> view rating </label>
                            <div class="slidecontainer">

                                <input type="range" min="1" max="100" value="50" class="slider" id="view" oninput="rangevalue1.value=value">
                                <output id="rangevalue1">50 </output>
                            </div>
                            <label for="comfort rating"> comfort rating </label>
                            <div class="slidecontainer">

                                <input type="range" min="1" max="100" value="50" class="slider" id="comfort" oninput="rangevalue2.value=value">
                                <output id="rangevalue2">50</output>
                            </div>
                            <label for="facilities rating"> facilities rating </label>
                            <div class="slidecontainer">

                                <input type="range" min="1" max="100" value="50" class="slider" id="facilities" oninput="rangevalue3.value=value">
                                <output id="rangevalue3">50</output>
                            </div>
                            <label for="room service rating"> room service rating </label>
                            <div class="slidecontainer">

                                <input type="range" min="1" max="100" value="50" class="slider" id="room service" oninput="rangevalue4.value=value">
                                <output id="rangevalue4">50</output>
                            </div>

                            <label for="comments and suggestions"> comments and suggestions</label>
                            <div class="num-of-occupants">

                                <input type='text' id='comment' name='comment'>
                            </div>
                            <div class="submit_rating">
                                <input type="submit" class="submit" id="submit" name="submit" ">
                        </div>
                    </form>
                
             </div>
            </div>
        </div>
    </div>


    <!-- End Of Body -->
    <!-- Footer -->
    <div class=" footer">
                                &copy; 2022
                                <span>MIU</span>
                                All Rights Reserved
                            </div>
                            <!-- End Of Footer -->

                            <?php

                            if ($_SERVER['REQUEST_METHOD'] != 'POST') die("Form was not submitted correctly");

                            // Gather data from POST
                            if (isset($_POST['submit'])) {
                                $overall_rating = $_POST['overall'];
                                $view_rating = $_POST['view'];
                                $comfort_rating = $_POST['comfort'];
                                $facilities_rating = $_POST['facilities'];
                                $room_service_rating = $_POST['room service'];
                                $comments = $_POST['comment'];
                            }

                            //submit data in db

                            $room_id_sql = "SELECT room_no FROM reservations WEHRE reservation_ID =$reservation_id ";
                            $result = run_query($room_id_sql);
                            $temp = $result->fetch_assoc();
                            $room_id = $temp['room_no'];

                            $submit_sql = "INSERT INTO  room_reviews 
(client_id, room_no, overall_rating, view_rating, comfort_rating, facilities_rating, room_service_rating, comments, reservation_id)
VALUES ('$client_ID', '$room_id' , '$overall_rating' ,'$view_rating', '$comfort_rating' , '$facilities_rating'
, '$room_service_rating', '$comments', '$reservation_id')";
                            run_query($submit_sql) or die(" error");

                            header("Location:http://localhost/Hurgada-GRND-Hotel/pages/reservation/my%20reservations.php");

                            ?>

</body>

</html
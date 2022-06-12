<html>

<head>
    <link href="../../global/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="functions.js"></script>
    <title> rate us </title>

    <?php
    include_once "../../global/php/db-functions.php";
    maintain_session();
    //redirect_to_login();
    ?>

    <style>
        .features {
            position: relative;
            height: 100%;
            margin-bottom: 50px;
            width: 60%;
            margin: auto;
        }

        .features .container {
            position: relative;
            width: 100%;
            margin: auto;
            font-family: "parg", serif;
            height: 90%;
        }

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
            position: relative;
            margin-top: 10px;
            color: white;
        }

        label {
            float: left;
        }
    </style>

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
    <script src="../../global/template/template.js"></script>
    <script src="functions.js"></script>
    <!-- Render All Alements Normally -->
    <link rel="stylesheet" href="./normalize.css" />
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="../../global/template/template.css" />
    <link rel="stylesheet" href="./reservation_css.css" />
    <?php
    if (isset($_GET['id']))
        $reservation_id = $_GET['id'];
    //$client_ID='$_SESSION['active_id']';
    $client_ID = '1';
    // make a skip rating option 
    ?>
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
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="submit_rating">
            <input type="submit" class="submit" id="submit" name="submit">
        </div>
    </div>
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

    $submit_sql = "INSERT INTO  room_reviews (client_id, room_no, overall_rating, view_rating, comfort_rating, facilities_rating, room_service_rating, comments, reservation_id)VALUES ('$client_ID', '$room_id' , '$overall_rating' ,'$view_rating', '$comfort_rating' , '$facilities_rating', '$room_service_rating', '$comments', '$reservation_id')";
    run_query($submit_sql) or die(" error");

    header("Location:http://localhost/Hurgada-GRND-Hotel/pages/reservation/my%20reservations.php");
    ?>

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
    <span class=" c-scroller_thumb"></span>
    <!--=============== End Of Footer ===============-->

</body>

</html
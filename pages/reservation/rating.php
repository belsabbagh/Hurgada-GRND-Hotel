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
    redirect_to_login();

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
                <?php echo load_navbar(get_active_user_type()); ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- End Of Header -->




   
</head>

<body>
    <!-- Body -->
    <div class="features">
        <div class="container2">
            <div class="feat">
                <div class="row col-md-12">
                    <div class="shadow col-md-6 mt-5 ">
                        <h2 class="titles"> rate us! </h2>
                        <form action="rate_us_form.php" method="post">
                            <label for="over all rating">over all rating </label>
                            <div class="slidecontainer  ">


                                <input type="range" min="1" max="100" value="50" class="slider" name="overall" id="overall" oninput="rangevalue.value=value">
                                <output id="rangevalue">50</output>
                            </div>

                            <label for="view rating"> view rating </label>
                            <div class="slidecontainer">

                                <input type="range" min="1" max="100" value="50" class="slider" name="view" id="view" oninput="rangevalue1.value=value">
                                <output id="rangevalue1">50 </output>
                            </div>
                            <label for="comfort rating"> comfort rating </label>
                            <div class="slidecontainer">

                                <input type="range" min="1" max="100" value="50" class="slider" name="comfort" id="comfort" oninput="rangevalue2.value=value">
                                <output id="rangevalue2">50</output>
                            </div>
                            <label for="facilities rating"> facilities rating </label>
                            <div class="slidecontainer">

                                <input type="range" min="1" max="100" value="50" class="slider" name="facilities" id="facilities" oninput="rangevalue3.value=value">
                                <output id="rangevalue3">50</output>
                            </div>
                            <label for="room service rating"> room service rating </label>
                            <div class="slidecontainer">

                                <input type="range" min="1" max="100" value="50" class="slider" name="room_service" id="room_service" oninput="rangevalue4.value=value">
                                <output id="rangevalue4">50</output>
                            </div>

                            <label for="comments and suggestions"> comments and suggestions</label>
                            <div class="num-of-occupants">

                                <input type='text' id='comment' name='comment'>
                                <input type='hidden' id='reservation_id' name='reservation_id' value = "<?php echo $_GET['id'];?>">
                            </div>
                            <div class="submit_rating">
                                <input type="submit" class="submit" id="submit" name="submit" >
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

                           
</body>

</html
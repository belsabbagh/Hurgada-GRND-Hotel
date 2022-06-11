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
    <script src="Home.js"></script>
    <!-- Render All Alements Normally -->
    <link rel="stylesheet" href="../../global/template/normalize.css" />
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="./Home.css" />
    <link rel="stylesheet" href="../../global/template/template.css" />
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
    <div class="background" id='bgr'>
        <div id="maintext" class="landing">
            <div class="intro-text">
                <h1>Hurghada <br>GRND Hotel<br>↑</h1>
                <p> Scroll up</p>
            </div>
        </div>
    </div>
    <div class="quote1 show" id="txt1"><i class='bx bxs-quote-alt-left'></i></div>
    <div class="quote2 show" id="txt2">It is a wonderful hotel, with<br>
        good location, beautiful<br>
        sandy beach, very high level<br>
        service, the employees are<br>
        very receptive and kind, the<br>
        atmosphere is wonderful.</div>
    <div class="sidepic"></div>
    <div class="quote3 show" id="txt3"><i class='bx bxs-quote-alt-left'></i></div>
    <div class="quote4 show" id="txt4">Almost every thing. A very warm and
        <br>welcoming family , the place is very
        <br>clean and very well organised All
        <br>facilities are new and clean. Rooms are<br>
        big and well designed for the price.
    </div>



    <a name="rooms"></a>
    <div class="rooms">
        <div class="txt">Rooms</div>
        <div class="slider">
            <input type="radio" name="slide" id="img1" checked>
            <input type="radio" name="slide" id="img2">
            <input type="radio" name="slide" id="img3">
            <input type="radio" name="slide" id="img4">

            <div class="slides">
                <div class="overflow">
                    <div class="inner">
                        <div class="slide m1">
                            <div class="content">
                                <img src="../../resources/img/home page/room4.jpg">
                                <h3>All our rooms are hand-crafted down to <br>
                                    the tiniest detail. They offer privacy, <br>
                                    shelter, and supreme comfort. we want to<br>
                                    offer you a home away from home, and we <br>
                                    do everything we can throughout your stay <br>
                                    to make this a reality.</h3>
                            </div>
                        </div>
                        <div class="slide m2">
                            <div class="content">
                                <img src="../../resources/img/home page/room3.jpg">
                                <h3>Our rooms are designed with a<br>
                                    secure lock designed to minimize <br>
                                    noise from other hotel guests. <br>
                                    The bed is of good quality,<br>
                                    clean, well maintained, and<br>
                                    well designed. It is alsowell <br>
                                    positioned in the room to <br>
                                    allow proper circulation.</h3>
                            </div>
                        </div>
                        <div class="slide m3">
                            <div class="content">
                                <img src="../../resources/img/home page/bathroom.jpg">
                                <h3 class="txtroom"> We will make sure our hotel<br>
                                    bathroom will leave our clients <br>
                                    slack-jawed with delight, <br>
                                    whether they’re visiting for <br>
                                    business or pleasure. The <br>
                                    shampoo, soap, towels and toilet <br>
                                    paper are regularly restocked. <br>
                                    That’s just the very basics, along<br>
                                    with making sure the bathroom<br>
                                    is spotlessly clean.</h3>
                            </div>
                        </div>
                        <div class="slide m4">
                            <div class="content">
                                <img src="../../resources/img/home page/room.jpg">
                                <h3 class="txtroom">We offer Convenient <br>
                                    location, free wifi,<br>
                                    Good lighting, television<br>
                                    with a good selection of<br>
                                    channels, an ironing <br>
                                    boar and iron, blackout<br>
                                    curtains.</h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="dots">
                <label for="img1"></label>
                <label for="img2"></label>
                <label for="img3"></label>
                <label for="img4"></label>
            </div>
        </div>
    </div>


    <a name="dine"></a>
    <div class="Dinning">
        <div class="container">
            <span>
                <img class="eat1 reveal" src="../../resources/img/home page/dining1.jpg">
                <img class="eat2 reveal" src="../../resources/img/home page/dining2.jpg">
            </span>
            <span class="txt">
                <h3>Dining</h3>
                <p>The rich flavors and ingredients inspire every dish.
                    Where Meals Are Extraordinary Events
                    Throughout the history of Grand Hotel, dining has been one
                    of the highlights of every guest experience. Here, each meal is
                    truly special thanks to the exceptional food by our chefs, unsurpassed service by our staff,
                    and distinct ambiances of our 14 bars and restaurants.
                </p>
            </span>
        </div>
    </div>

    <a name="exp"></a>
    <div class="Exp">
        <div class="container">
            <span class="txt">
                <h3>Experience</h3>
                <p>Grand Hotel schedule suggestions is like a “greatest hits” package
                    of the many experiences to enjoy during your stay with us.</p>
            </span>
            <span>
                <img class="exp1" src="../../resources/img/home page/Exp1.jpg">
                <img class="exp2" src="../../resources/img/home page/Exp2.jpg">
                <img class="exp3" src="../../resources/img/home page/Exp3.jpg">
            </span>
        </div>
    </div>


    <div class="map">
        <a name="loc"></a>
        <h3 class="maptxt">Location</h3>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d28414.733333059197!2d33.8191758!3d27
    .0982879!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1452802a6ea246ff%3A0x41b07b3be5267297!2sThe%20Grand%20Hotel
    !5e0!3m2!1sen!2seg!4v1651243819292!5m2!1sen!2seg" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="maps"></iframe>
    </div>


    <a name="about"></a>
    <div class="features">
        <div class="feat">
            <i class="fas fa-magic fa-3x"></i>
            <h3>Hurghada GRND Hotel</h3>
            <p>Hurghada GRND Hotel is one of the biggest Hotels in Hurghada. It has been operating in
                Hurghada since 1910. At this time, the guests were few and can be served while enjoying their
                stay in the Hotel. Now, the number of guests has increased and the types of the guests have
                become different. For example, now some guests are staying in the Hotel and others ask for
                only day use. The Hotel decided to have it's own website to automate the work and make
                things easier for you.</p>
        </div>
    </div>
    <!--=============== End Of Body ===============-->


    
    <!--=============== Footer ===============-->
    <footer class='footer' style='background-color: var(--blue0-color);'>
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
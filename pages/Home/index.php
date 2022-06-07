<?php
include_once "../../global/php/db-functions.php";
if (!isset($_SESSION))
{
    session_start();
}
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
    <!-- Main JS File -->
    <script src="Home.js"></script>
    <script src="../../global/template/template.js"></script>
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="../../global/template/normalize.css"/>
    <link rel="stylesheet" href="../../global/template/template.css"/>
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="./Home.css"/>
</head>

<body>
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
            <div class='book' id="book"><a href="<?php echo REPOSITORY_PAGES_URL . "booking" ?>">Book now</a></div>
            <ul id="bar">
                <li><a href="Profile"><em class='bx bxs-user'></em>Profile</a></li>
                <li><a href="MyReservations"><em class='bx bxs-bed'></em> My Reservations</a></li>
                <li><a href="RateUs"><em class='bx bxs-star'></em> Rate us</a></li>
                <li><a href="ContacUs"><em class='bx bxl-gmail'></em> Contact us</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="background" id='bgr'>
    <div id="maintext" class="landing">
        <div class="intro-text">
            <h1>Hurgada<br>GRND Hotel<br>↑</h1>
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
    atmosphere is wonderful.
</div>
<div class="side-pic"></div>
<div class="quote3 show" id="txt3"><i class='bx bxs-quote-alt-left'></i></div>
<div class="quote4 show" id="txt4">Almost every thing. A very warm and
    <br>welcoming family , the place is very
    <br>clean and very well organised All
    <br>facilities are new and clean. Rooms are<br>
    big and well designed for the price.
</div>


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
    <h3 class="map-txt">Location</h3>
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d28414.733333059197!2d33.8191758!3d27
    .0982879!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1452802a6ea246ff%3A0x41b07b3be5267297!2sThe%20Grand%20Hotel
    !5e0!3m2!1sen!2seg!4v1651243819292!5m2!1sen!2seg" width="800" height="600" style="border:0;" allowfullscreen=""
            loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="maps"></iframe>
</div>


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
<!-- Footer -->
<div class="footer">
    &copy; 2022
    <span>MIU</span>
    All Rights Reserved
</div>
<span class="c-scroller_thumb"></span>
</body>

</html>
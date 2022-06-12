<html>

<head>

    <link href="../../global/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../reservation/reservation_css.css"/>
    <script src="../../global/Template/template.js"></script>
    <script src="functions.js"></script>
    <?php
    include_once "../../global/php/db-functions.php";
    maintain_session();
    //redirect_to_login();
    //restrict_to_staff();

    ?>
    <style>
        #submit_search {
            right: 100%;
        }
        .add_room_btn{

            position: relative;
            left: 60%;
            top: 80%;
            width: 40%;
        }

    </style>

    <title> rooms</title>

    <?php $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hurgada-grnd-hotel";

    $connect = new mysqli($server, $username, $password, $dbname); ?>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HURGADA-GRND-HOTEL</title>
    <link rel="icon" href="../../resources/img/pretty stuff/hurghada-beach.jpg">
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- Main JS File -->
    <script src="template.js"></script>
    <!-- Render All Alements Normally -->
    <link rel="stylesheet" href="./normalize.css"/>
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="./template.css"/>


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


</head>

<body>


<!-- Body -->


<div class="features">
    <div class="container">
        <div class="feat">

            <div class="search_by_id">

                <!--search for client by id-->
                <form action='' method='post'>

                    <P> search by room ID </p>
                    <input type="text" name="room_id" id="search"> <b>
                        <!-- <input type="submit" name="submit" id="submit" class="submit">-->
                        <input type="submit" id="submit_search" name="search">

                </form>


            </div>


            <table>
                <tr>

                    <th> room ID</th>
                    <th> room type id </th>
                    <th> occupied </th>
                    <th> room view </th>
                    <th> outdoors </th>
                    <th> number of beds</th>
                    <th> base price </th>
                    <th> edit room</th>
                    <th> delete room</th>
                </tr>

                <?php

                // get the id of the users using search
                //$client_ID='$_SESSION['active_id']';
                //$client_ID = '1';

                //search for client by id
                if (array_key_exists('room_id', $_POST))
                {
                    $room_ID = $_POST['room_id'];
                    $sql = " SELECT * from rooms where room_id= '$room_ID' ";
                } else $sql = " SELECT * from rooms ";
                $result = $connect->query($sql);

                if (empty_mysqli_result($result))
                    echo "<p class ='paragraph' > no reservations</p>";
                else
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        echo "<tr><td>" . $row["room_id"] . "</td>
                            <td>" . get_room_type_by_id($row["room_type_id"] ). "</td>
                            <td>" . yes_or_no($row["occupied"]) . "</td>
                            <td>" . get_room_view_by_id($row["room_view"]) . "</td> 
                            <td>" . get_room_outdoor_by_value($row["room_patio"]) . "</td>
                            <td>" . $row["room_beds_number"] . "</td>
                            <td>" . $row["room_base_price"] . "</td>";
                        $room_number = $row['room_id'];

                        echo "<td><a href ='http://localhost/Hurgada-GRND-Hotel/pages/rooms/edit_room.php?id=$room_number' class= 'temp2'> edit </a> </td>";
                        
                        echo "<td><a href  ='http://localhost/Hurgada-GRND-Hotel/pages/rooms/delete_room.php?id=$room_number' class= 'temp2'> delete </a> </td>";

                    
                    }
                }
                ?>
            </table>

            <div class="add_room_btn">

            <a href="http://localhost/Hurgada-GRND-Hotel/pages/rooms/add_room.php" class="temp" > add room </a>

            </div>


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

</body>

</html>
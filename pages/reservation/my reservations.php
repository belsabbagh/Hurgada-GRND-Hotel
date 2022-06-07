<html>

<head>

    <link href="../../global/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./reservation_css.css" />
    <script src="../../global/Template/template.js"></script>
    <script src="functions.js"></script>


    <title> my reservations</title>

    <?php
    include_once "../../global/php/db-functions.php";
    maintain_session();
    redirect_to_login();
    
    $server = "localhost";
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
                    <span class="container">
                        <span>Home</span>
                    </span>
                    <span class="container">
                        <span>Rooms</span>
                    </span>
                    <span class="container">
                        <span>Dining</span>
                    </span>
                    <span class="container">
                        <span>Experience</span>
                    </span>
                    <span class="container">
                        <span>Location</span>
                    </span>
                    <span class="container">
                        <span>About</span>
                    </span>
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
                
                    <table>
                        <tr>

                            <th> reservation id </th>
                            <th> Room number </th>
                            <th> checked in </th>
                            <th> checked out </th>
                            <th> numberof adults </th>
                            <th> numberof children </th>
                            <th> extra bed </th>
                            <th> edit </th>
                            <th> delete </th>
                            <th> check in/out </th>

                        </tr>

                        <?php

                        // get the id of the user
                        //$client_ID='$_SESSION['active_id']';
                        $client_ID = '1';
                        $sql = " SELECT * from reservations where client_id= '$client_ID' ";
                        $result = $connect->query($sql);

                        if ($result->num_rows == 0)
                            echo "<p class ='paragraph' > no reservations</p>";
                        else {
                                //echo $result->num_rows;
                            ;
                            //for($i=0; $i<$result->num_rows; $i++)
                            while ($row = mysqli_fetch_assoc($result)) {

                                echo "<tr><td>" . $row["reservation_id"] . "</td><td>" . $row["room_no"] . "</td><td> " . $row["start_date"] . "</td> 
                            <td>" . $row["end_date"] . "</td>
                            <td>" . $row["numberof_adults"] . "</td>
                            <td>" . $row["numberof_children"] . "</td>
                             <td>" . $row["extra_bed"] . "</td>
                            ";
                                $reservation_id = $row['reservation_id'];

                                echo "<td><a href ='edit_reservation.php?id=$reservation_id' class= 'temp2'> edit </a> </td>";
                                echo "<td><a href  ='delete_reservations.php?id=$reservation_id' class= 'temp2'> delete </a> </td>";

                                $is_checked_in = $row['is_checked_in'];
                                if ($is_checked_in == 0)
                                    echo "<td><a href='check_in.php?id=$reservation_id' class ='temp'> check in </a> </td></tr>";

                                else
                                    echo "<td><a href='check_out.php?id=$reservation_id' class ='temp'> check out </a> </td></tr>";
                            }
                        }
                        ?>
                    </table>



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
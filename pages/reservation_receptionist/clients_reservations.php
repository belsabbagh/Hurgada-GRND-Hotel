<html>

<head>

    <link href="../../global/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../reservation/reservation_css.css"/>
    <script src="../../global/template/template.js"></script>
    <script src="functions.js"></script>
    <?php
    include_once "../../global/php/db-functions.php";
    maintain_session();
    redirect_to_login();
    restrict_to_staff();
    ?>
    <style>
        #submit_search {
            right: 100%;
        }

    </style>

    <title> clients' reservations</title>

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
    <!-- Render All Alements Normally -->
    <link rel="stylesheet" href="./normalize.css"/>
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="../../global/template/template.css"/>
    <link rel='stylesheet' href='../../global/template/receptionist_temp.css'/>
</head>

<body>

<!-- Header -->

<!-- End Of Header -->

<!-- Body -->


<div class="features">
    <div class="container">
        <div class="feat">

            <div class="search_by_id">

                <!--search for client by id -->
                <form action='' method='post'>

                    <P> search by client ID </p>
                    <input type="text" name="client_id" id="search"> <b>
                        <!-- <input type="submit" name="submit" id="submit" class="submit">-->
                        <input type="submit" id="submit_search" name="search" style=" right: 35%; position: absolute;">

                </form>


            </div>


            <table>
                <tr>

                    <th> client id</th>
                    <th> reservation id</th>
                    <th> Room number</th>
                    <th> checked in</th>
                    <th> checked out</th>
                    <th> numberof adults</th>
                    <th> numberof children</th>
                    <th> extra bed</th>
                    <th> edit</th>
                    <th> delete</th>
                    <th> check in/out</th>

                </tr>

                <?php

                // get the id of the users using search
                //$client_ID='$_SESSION['active_id']';
                //$client_ID = '1';

                //search for client by id
                if (array_key_exists('client_id', $_POST))
                {
                    $client_ID = $_POST['client_id'];
                    $sql = " SELECT * from reservations where client_id= '$client_ID' ";
                } else $sql = " SELECT * from reservations ";
                $result = $connect->query($sql);

                if (empty_mysqli_result($result))
                    echo "<p class ='paragraph' > no reservations</p>";
                else
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        echo "<tr><td>" . $row["client_id"] . "</td><td>" . $row["reservation_id"] . "</td><td>" . $row["room_no"] . "</td><td> " . $row["start_date"] . "</td> 
                            <td>" . $row["end_date"] . "</td>
                            <td>" . $row["numberof_adults"] . "</td>
                            <td>" . $row["numberof_children"] . "</td>
                             <td>" . $row["extra_bed"] . "</td>
                            ";
                        $reservation_id = $row['reservation_id'];

                        echo "<td><a href ='../reservation_receptionist/edit_for_clients.php?id=$reservation_id' class= 'temp2'> edit </a> </td>";
                        echo "<td><a href  ='../reservation/delete_reservations.php?id=$reservation_id' class= 'temp2'> delete </a> </td>";

                        $is_checked_in = $row['is_checked_in'];
                        if ($is_checked_in == 0)
                            echo "<td><a href='../reservation/check_in.php?id=$reservation_id' class ='temp'> check in </a> </td></tr>";

                        else
                            echo "<td><a href='../reservation/check_out.php?id=$reservation_id' class ='temp'> check out </a> </td></tr>";
                    }
                }
                ?>
            </table>


        </div>
    </div>
</div>

<div class='sidebar'>
    <ul>
        <?php echo load_navbar(get_active_user_type()); ?>
    </ul>
</div>
<!-- End Of Body -->

</body>

</html>
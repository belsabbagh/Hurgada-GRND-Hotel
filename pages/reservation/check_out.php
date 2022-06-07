<html>

<head>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="./msg_.css" />
    <link href="../../global/css/style.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <script src="functions.js"></script>
    <title> checking out </title>
    <?php include_once "../../global/php/db-functions.php";
    maintain_session();
    redirect_to_login();

    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hurgada-grnd-hotel";

    $connect = new mysqli($server, $username, $password, $dbname);

    if (isset($_GET['id']))
        $reservation_id = $_GET['id'];
    else echo "error";
    //$client_ID='$_SESSION['active_id']';
    $client_ID = 1;
    ?>

</head>

<body> <?php

        $check_out_msg = "are you sure you want to check out?";
        $check_out_header = "check out ";

        confirmmsg($check_out_msg, $check_out_header);
        //not confirmed, go back to my reservations
        if (isset($_POST["no_btn"])) {

            header("Location:http://localhost/Hurgada-GRND-Hotel/pages/reservation/my%20reservations.php");
        }

        //confirmed 
        else if (isset($_POST["yes_btn"])) {

            $check_out_sql = "UPDATE reservations SET is_checked_in = 0 where client_id = $client_ID AND reservation_id =$reservation_id";
            $result = mysqli_query($connect, $check_out_sql);
            if ($result) {

                // rate us pop msg
                $rating_msg = "rate us?";
                $rating_header = "rate us ";
                $link1 = "http://localhost/Hurgada-GRND-Hotel/pages/reservation/my%20reservations.php";
                $link2 = "http://localhost/Hurgada-GRND-Hotel/pages/reservation/rating.php";

                confirmmsg2($rating_msg, $rating_header, $link1, $link2);
            }
        }
        ?>

</body>

</html>
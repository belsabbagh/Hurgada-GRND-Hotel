<?php

function db_connect()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hurgada-grnd-hotel";
    return new mysqli($servername, $username, $password, $dbname);
}

function activity_log($action, $description, $transaction)
{
    $conn = db_connect();
    $sql = "INSERT into activity_log(owner, actiontype, description, transaction) values(/*TODO user id*/,'$action', '$description', $transaction)";

    $conn->query($sql) or die("Query Failed");
    $conn->close();
}

function load_room_types()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hurgada-grnd-hotel";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "select * from room_types";

    $result = $conn->query($sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<input type='radio' name='room_type' id='{$row['room_category']}' value='{$row['type_id']}' onchange='change_max_beds()'><label for='{$row['room_category']}'>{$row['room_category']}</label>\n";
    }
    $conn->close();
}

function load_room_views()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hurgada-grnd-hotel";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "select * from room_views";

    $result = $conn->query($sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<input type='radio' name='room_view' id='{$row['room_view_title']}' value='{$row['room_view_id']}'><label for='{$row['room_view_title']}'>{$row['room_view_title']}</label>\n";
    }
    $conn->close();
}
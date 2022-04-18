<?php

/**
 * Gets the difference between two dates in days
 *
 * @param string $from_date The starting date
 * @param string $to_date The ending date
 *
 * @return  int  The difference in days
 * @author @Belal-Elsabbagh
 *
 */
function get_numberof_days_between_dates(string $from_date, string $to_date): int
{
    return (int)round((strtotime($to_date) - strtotime($from_date)) / (60 * 60 * 24));
}

/**
 * Runs booking from form.php
 *
 * @return  void
 * @var     string $checkin_date
 * @var     string $checkout_date
 * @var     int $nAdults
 * @var     int $nChildren
 * @var     int $room_type
 * @var     int $room_view
 * @var     int $patio
 * @var     int $nBeds
 *
 * @author  @Belal-Elsabbagh
 *
 */
function book()
{
// Gather data from POST
    $checkin_date = (string)$_POST['checkin'];
    $checkout_date = (string)$_POST['checkout'];
    $nAdults = intval($_POST['adults']);
    $nChildren = intval($_POST['children']);
    $room_type = intval($_POST['room_type']);
    $room_view = intval($_POST['room_view']);
    $patio = intval($_POST['outdoors']);
    $nBeds = intval($_POST['room_beds_number']);

// Check Constraints
    if ($checkin_date > $checkout_date) die("Invalid dates");
    include_once "../../../global/php/db-functions.php";

    $get_rooms = "SELECT room_id FROM rooms 
        where room_id NOT IN 
        (
            SELECT room_no FROM reservations 
            WHERE (start_date BETWEEN '$checkin_date' AND '$checkout_date') 
            OR (end_date BETWEEN '$checkin_date' AND '$checkout_date') 
            OR (start_date >= '$checkin_date' AND end_date <= '$checkout_date')
        )
        AND room_type_id = $room_type 
        AND room_view = $room_view
        AND room_patio = $patio
        AND room_beds_number = $nBeds;";

// Check if a room with these options exist
    $result_rooms = run_query($get_rooms);
    if (mysqli_num_rows($result_rooms) == 0) die("No room matches these options");
    $room = mysqli_fetch_assoc($result_rooms);

    $price = get_numberof_days_between_dates($checkin_date, $checkout_date) * (float)$room['room_base_price'];

    $book_query = "insert into reservations
    values(
        NULL, 
        1/*TODO Insert client id*/, 
        {$room['room_id']}, 
        '$checkin_date', 
        '$checkout_date', 
        $nAdults, 
        $nChildren, 
        $price,
       0);";

    run_query($book_query);
    activity_log("Room Reservation", "Client {$_SESSION['active_id']} reserved room number {$room['room_id']} from $checkin_date to $checkout_date for $nAdults adults and $nChildren children.", $price);
}

if (!isset($_POST['submit'])) die("Form was not submitted correctly");
book();
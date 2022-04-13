<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../global/css/style.css">
    <link rel="stylesheet" href="style.css">
    <script src="functions.js"></script>
    <?php include "../../global/php/db-functions.php"; ?>
    <title>Booking</title>
</head>

<body>
<form action="book-client.php" method="post">
    <div class="checkin-checkout-dates">
        <label for="checkin">Check in date</label>
        <input type="date" id="checkin" name="checkin" onchange="set_date_constraints()">

        <label for="checkout">Check out date</label>
        <input type="date" id="checkout" name="checkout" onchange="set_date_constraints()">
    </div>
    <div class="num-of-occupants">
        <label for="adults">Number of adults</label>
        <input type="number" id="adults" name="adults" min="1">

        <label for="children">Number of children</label>
        <input type="number" id="children" name="children" min="0">
    </div>
    <div class="options">
        <div class="room_type">
            <?php load_room_types(); ?>
            </div>
            <div class="view">
                <?php load_room_views(); ?>
            </div>
        <div class="outdoors">
            <input type="radio" name="outdoors" id="outdoors_balcony" value="false">
            <label for="outdoors_balcony">Balcony</label>
            <input type="radio" name="outdoors" id="outdoors_patio" value="true">
            <label for="outdoors_patio">Patio</label>
        </div>
        <input type="number" id="room_beds_number" name="room_beds_number" value="1" min="1" max="4">
        <label for="room_beds_number">Number of beds</label>
    </div>
    <input type="submit" id="submit" name="submit">
</form>
</body>

</html>
<?php
include_once "../../global/php/db-functions.php";
$conn = new mysqli("localhost", "root", "", "hurgada-grnd-hotel2");
if ($conn->connect_errno)
    throw new RuntimeException('mysqli connection error: ' . $conn->connect_error, $conn->connect_errno);
$query = "SELECT overall_rating,COUNT(DISTINCT client_id) AS numOfusers 
         FROM room_reviews ,users 
         WHERE  room_id = '1' AND client_id = user_id
         GROUP BY overall_rating;";
$getData = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- highcharts libraries -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <title>Chart data</title>
    <!-- the css file -->
    <link rel="stylesheet" href="./chart.css">
    <!-- the display style -->
    <style>.center-block {
            display: block;
            margin-left: auto;
            margin-right: auto;
        } </style>
</head>

<body class='d-flex flex-column min-vh-100'>
<!-- Header -->
<nav class='navbar' id='header'>
    <div class='container-fluid'>
        <div class='navbar-header' onclick='showbar()'>
            <span class='navbar-brand'><em class='bx bx-menu-alt-left icon'></em></span>
        </div>
        <div class='row'>
            <ul class='nav items' id='items'>
                <?php echo load_header_bar(get_active_user_type(), true); ?>
            </ul>
        </div>
        <div class="">
            <span id='icon2' class='icon2' onclick='hidebar()'><em class='bx bx-x'></em></span>
        </div>
        <span class='book nav navbar-nav navbar-right nav-link-container text-center' id='book'><a
                    class='nav-link nlink' href='#'>Book now</a></span>
    </div>
</nav>
<!-- End Of Header -->
<div class="features">
    <div class="container">
        <table>
            <thead>
            <tr>
                <th>Statistics</th>
                <th>Value</th>
            </tr>
            </thead>
            <tbody>
            <?php
        $RoomQuery = "SELECT COUNT(room_id) AS numOfrooms 
                      FROM room_reviews 
                      WHERE  overall_rating = '5'
                      GROUP BY overall_rating";
        $numRooms = $conn->query($RoomQuery);

        $clientQuery = "SELECT COUNT(client_id) AS numOfclients
                      FROM room_reviews 
                      WHERE  overall_rating = '5'
                      GROUP BY overall_rating";
        $numClients = $conn->query($clientQuery);

        $EditQuery = "SELECT COUNT(actiontype) AS numOfEdits
                      FROM activity_log
                      WHERE  actiontype = 'Edit reservation' ";
        $numEdits = $conn->query($EditQuery);

        $CancelQuery = "SELECT COUNT(actiontype) AS numOfCancels
                      FROM activity_log
                      WHERE  actiontype = 'Cancel reservation' ";
        $numCancels = $conn->query($CancelQuery);

        $MostOrderedQuery = "SELECT room_no
                                 FROM reservations
                                 GROUP BY room_no
                                 ORDER BY COUNT(*) DESC
                                 LIMIT 1 ";
        $numMostOrdered = $conn->query($MostOrderedQuery);

        while ($row = mysqli_fetch_assoc($numRooms)) {
            echo
            "<tr>
                   <td>Number of '5' rated rooms</td>
                   <td>{$row['numOfrooms']}</td>
                </tr>\n";
        }
        while ($row = mysqli_fetch_assoc($numClients)) {
            echo
            "<tr>
                   <td>Number of clients with '5' rating</td>
                   <td>{$row['numOfclients']}</td>
                </tr>\n";
        }
        while ($row = mysqli_fetch_assoc($numEdits)) {
            echo
            "<tr>
                   <td>Number of clients who edited their reservation</td>
                   <td>{$row['numOfEdits']}</td>
                </tr>\n";
        }
        while ($row = mysqli_fetch_assoc($numCancels)) {
            echo
            "<tr>
                   <td>Number of clients who canceled their reservation</td>
                   <td>{$row['numOfCancels']}</td>
                </tr>\n";
        }
        while ($row = mysqli_fetch_assoc($numMostOrdered)) {
            echo
            "<tr>
                   <td>The most ordered room</td>
                   <td>{$row['room_no']}</td>
                </tr>\n";
        }
        ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<figure class="my-chart">
    <div id="container"></div>
    <p class="description">
        pie chart for reviews
    </p>
</figure>
</div>
<script>
    // Build the chart
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Customer reviews'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Reviews',
            colorByPoint: true,
            data: [
                <?php
                $data = '';
                if ($getData->num_rows > 0) {
                    while ($row = $getData->fetch_object()) {
                        $data .= '{name:"' . $row->overall_rating . '",y:' . $row->numOfusers . '},';
                    }
                }
                echo $data;
                ?>
            ]
        }]
    });
</script>
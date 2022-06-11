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
    <link rel="stylesheet" href="chart.css">
    <!-- the display style -->
    <style>.center-block {
            display: block;
            margin-left: auto;
            margin-right: auto;
        } </style>
</head>
<body>
<div class="container">

</div>

</body>
</html>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        pie chart for reviews
    </p>
</figure>
<?php
$conn = new mysqli("localhost", "root", "", "hurgada-grnd-hotel2");
if ($conn->connect_errno)
    throw new RuntimeException('mysqli connection error: ' . $conn->connect_error, $conn->connect_errno);
$query = "SELECT overall_rating,COUNT(DISTINCT client_id) AS numOfusers 
         FROM room_reviews ,users 
         WHERE  room_id = '1' AND client_id = user_id
         GROUP BY overall_rating;";
$getData = $conn->query($query);
?>
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
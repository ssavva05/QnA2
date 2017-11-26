<?php
//I WILL PUT THIS HEADER ON TOP OF EACH UNIQUE PAGE

session_start();

//if (!isset($_SESSION['username'])) {
//    return header("location:../index.php");
//}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Results</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="./css/style.css" rel="stylesheet" type="text/css">
        <script src="js/Chart.bundle.js" type="text/javascript"></script>
        <script src="js/utils.js" type="text/javascript"></script>
        <script src="js/jquery-2.2.4.min.js" type="text/javascript"></script>
    </head>

    <body>
        <div id="canvas-holder" style="width:100%">
            <!--<canvas id="chart-area" />-->
            <canvas id="myLineChart" width="740" height="200"></canvas>
        </div>


        <script>
            function drawLineChart() {

                // Add a helper to format timestamp data
                Date.prototype.formatMMDDYYYY = function () {
                    return (this.getMonth() + 1) +
                            "/" + this.getDate() +
                            "/" + this.getFullYear();
                }

                var jsonData = $.ajax({
                    url: 'http://d.microbuilder.io:8080/test/temp',
                    dataType: 'json',
                }).done(function (results) {

                    // Split timestamp and data into separate arrays
                    var labels = [], data = [];
                    results["packets"].forEach(function (packet) {
                        labels.push(new Date(packet.timestamp).formatMMDDYYYY());
                        data.push(parseFloat(packet.payloadString));
                    });

                    // Create the chart.js data structure using 'labels' and 'data'
                    var tempData = {
                        labels: labels,
                        datasets: [{
                                fillColor: "rgba(151,187,205,0.2)",
                                strokeColor: "rgba(151,187,205,1)",
                                pointColor: "rgba(151,187,205,1)",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgba(151,187,205,1)",
                                data: data
                            }]
                    };

                    // Get the context of the canvas element we want to select
                    var ctx = document.getElementById("myLineChart").getContext("2d");

                    // Instantiate a new chart
                    var myLineChart = new Chart(ctx).Line(tempData, {
                        //bezierCurve: false
                    });
                });
            }

            drawLineChart();
        </script>
    </body>
</html>

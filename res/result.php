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
        <div id="canvas-holder" style="width:40%">
            <canvas id="chart-area" />
        </div>
        
        <script>
          var dynamicData = [
    { label: "One", value: 23 },
    { label: "Two", value: 33 },
    { label: "Three", value: 43 },
    { label: "Four", value: 53 }
];

dynamicData.forEach(function (e, i) {
    e.color = "hsl(" + (i / dynamicData.length * 360) + ", 50%, 50%)";
    e.highlight = "hsl(" + (i / dynamicData.length * 360) + ", 50%, 70%)";
    // + any other code you need to make your element into a chart.js pie element
});

var ctx = document.getElementById("myChart").getContext("2d");
var myPieChart = new Chart(ctx).Pie(dynamicData);
        </script>

    </body>
</html>

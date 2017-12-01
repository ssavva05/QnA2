<?php
session_start();

//if (!isset($_SESSION['username'])) {
//    return header("location:../index.php");
//}


$temptab = filter_input_array(INPUT_POST);
if (empty($temptab)) {
    return header("location:../index.php");
} else {



//setting header to json
    //header('Content-Type: application/json');
    //$tbl_quest = "question";
    //$tbl_ans = "answer";
//print_r($temptab);

    foreach ($temptab as $key => $value) {
        $lid = $value;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Chart</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="./css/style.css" rel="stylesheet" type="text/css">
        <link href="./css/toggle.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            #chart-container {
                width: auto;
                height: auto;
            }
        </style>
    </head>

    <div class="row">
        <div class="col-md-3 col-md-offset-5">
            <h1> Lecture Results</h1>
        </div>
    </div>
    <body>
        <div id="chart-container">
            <canvas id="mycanvas"></canvas>
        </div>

        <!-- javascript -->
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/Chart.min.js"></script>

<!--<script type="text/javascript" src="js/app.js"></script>-->


        <script>


            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

            $(document).ready(function () {
                $.ajax({
                    url: "http://localhost/QnA/res/lecdata.php",
                    method: "POST",
<?= "data : {" . $lid . " : " . $lid . "}," ?>

                    success: function (data) {
                        //console.log(data);
                        var player = [];
                        var score = [];
                        var color = [];


                        for (var i in data) {
                            player.push("Q:  " + data[i].textofquestion);
                            score.push(data[i].counter);
                            color.push(getRandomColor());
                        }

                        var chartdata = {
                            labels: player,
                            datasets: [
                                {
                                    label: 'Number of Correct Answers',
                                    backgroundColor: color,
                                    borderColor: 'rgba(200, 200, 200, 0.75)',
                                    hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                                    data: score
                                }
                            ]
                        };

                        var ctx = $("#mycanvas");

                        var barGraph = new Chart(ctx, {
                            type: 'horizontalBar',
                            data: chartdata,
                            options: {
                                responsive: true,
                                scales: {
                                    yAxes: [{
                                            ticks: {
                                                beginAtZero: false
                                            }
                                        }],
                                    xAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                }
                            }
                        });
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });


        </script>




    </body>
</html>
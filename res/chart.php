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
        $qidd = $value;
    }
}

$tbl_quest = "question";
$tbl_ans = "answer";

//$lectureID = $_SESSION['lid']; /////Fix it afterwards
$lectureID = 1;

$db = new \stdClass();
$db->host = "localhost"; // Host name
$db->username = "root"; // Mysql username
$db->password = "root"; // Mysql password
$db->db_name = "qnadb"; // Database name
//$db->tbl_lecture = $tbl_lecture;


try {
    // Connect to server and select database.
    $db->conn = new PDO('mysql:host=' . $db->host . ';dbname=' . $db->db_name . ';charset=utf8', $db->username, $db->password);
    $db->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\Exception $e) {
    die('Database connection error');
}

$stmt = $db->conn->prepare("SELECT textofquestion,textofanswer  FROM " . $tbl_quest . " WHERE qidd = :qID");
$stmt->bindParam(':qID', $qidd);
$stmt->execute();

// Gets query result
$result = $stmt->fetch(PDO::FETCH_ASSOC);
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
            <h1> Question Results </h1>
        </div>
    </div>
    <hr />
    <?php
    $z = 0;
    foreach ($result as $key => $value) {
        //echo ($value);

        if ($z == 0) {
            ?>
            <div class="row">
                <div class="col-md-3 col-md-offset-5">
                    <h3>Question: <?= $value ?></h3>  
                </div>
            </div>
            <?php
            $z++;
        } else {
            ?>
            <div class="row">
                <div class="col-md-3 col-md-offset-5">
                    <h3>Correct Answer:<?= $value ?></h3>
                </div>
            </div>
            <?php
        }
    }
    ?>

    <?php
    unset($result);
    ?>

    <hr />
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
                url: "http://localhost/QnA/res/data.php",
                method: "POST",
<?= "data : {" . $qidd . " : " . $qidd . "}," ?>

                success: function (data) {
                    //console.log(data);
                    var player = [];
                    var score = [];
                    var color = [];


                    for (var i in data) {
                        player.push("Answer: " + data[i].textofanswer);
                        score.push(data[i].counter);
                        color.push(getRandomColor());
                    }

                    var chartdata = {
                        labels: player,
                        datasets: [
                            {
                                label: 'Player Score',
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
                        type: 'pie',
                        data: chartdata,
                        options: {
                            responsive: true}
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
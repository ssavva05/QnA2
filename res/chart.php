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
        $qid = $value;
    }
}   
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Chart</title>
		<style type="text/css">
			#chart-container {
				width: auto;
				height: auto;
			}
		</style>
	</head>
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

$(document).ready(function(){
	$.ajax({
		url: "http://localhost/QnA/res/data.php",
		method: "POST",
                
                <?="data : {". $qid." : ".$qid."}," ?>
                
		success: function(data) {
			//console.log(data);
			var player = [];
			var score = [];
			var color = [];
			

			for(var i in data) {
				player.push("Answer:" + data[i].textofanswer);
				score.push(data[i].counter);
				color.push(getRandomColor());
			}

			var chartdata = {
				labels: player,
				datasets : [
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
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});
                
                </script>
                
                
                
                
	</body>
</html>
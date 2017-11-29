<?php

session_start();

//if (!isset($_SESSION['username'])) {
//    return header("location:../index.php");
//}
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
		<script type="text/javascript" src="js/app.js"></script>
	</body>
</html>
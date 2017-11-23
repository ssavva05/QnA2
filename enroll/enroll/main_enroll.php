<?php
session_start();
if (isset($_SESSION['enroll_key'])) {
    header("location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Enroll</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">
  </head>

  <body>
    <div class="container">

      <form class="form-signin" name="form1" method="post" action="checkenroll.php">
        <h2 class="form-signin-heading">Please Enroll</h2>
        <input name="myenrollkey" id="myenrollkey" type="password" class="form-control" placeholder="Enrollment key" autofocus>
        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Enroll</button>
        <div id="message"></div>
      </form>

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-2.2.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!-- The AJAX login script -->
    <script src="js/enroll.js"></script>

  </body>
</html>

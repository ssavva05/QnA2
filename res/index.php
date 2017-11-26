<?php
//I WILL PUT THIS HEADER ON TOP OF EACH UNIQUE PAGE
session_start();

//if (!isset($_SESSION['username'])||!isset($_SESSION['lectureid'])) {
//    return header("location:../index.php");
//}
///make the result making page
$tbl_quest = "question";
$tbl_ans = "answer";

$lectureID = $_SESSION['lectureid'];
$ek = stripslashes($questionID);
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
        <?php
        // query  SELECT qid,textofquestion FROM `question` WHERE lid=1 
        //Find specific results for each question    
        $stmt = $db->conn->prepare("SELECT qid,textofquestion FROM " . $tbl_quest . " WHERE lid = :lectureID");
        $stmt->bindParam(':lectureID', $lectureID);
        $stmt->execute();

        // Gets query result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        
        ?>


    </body>
</html>>



<?php
//I WILL PUT THIS HEADER ON TOP OF EACH UNIQUE PAGE
session_start();

//if (!isset($_SESSION['username'])||!isset($_SESSION['lectureid'])) {
//    return header("location:../index.php");
//}
///make the result making page
$tbl_quest = "question";
$tbl_ans = "answer";

//$lectureID = $_SESSION['lectureid']; /////Fix it afterwards
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
        <link href="./css/toggle.css" rel="stylesheet" type="text/css">
        <script src="js/Chart.bundle.js" type="text/javascript"></script>
        <script src="js/utils.js" type="text/javascript"></script>
        <script src="js/jquery-2.2.4.min.js" type="text/javascript"></script>
    </head>


    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-md-offset-5">
                    <h1> Question Activation</h1>
                </div>
            </div>

            <?php
            // SELECT qid,textofquestion,seen,textofanswer FROM `question` WHERE lid=1 
            //Find specific results for each question    
            $stmt = $db->conn->prepare("SELECT qid,textofquestion,seen,textofanswer  FROM " . $tbl_quest . " WHERE lid = :lectureID");
            $stmt->bindParam(':lectureID', $lectureID);
            $stmt->execute();

            // Gets query result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $i = 0;

            while ($result != NULL && $result != "" && $result != " " && (isset($result))) {
                foreach ($result as $key => $value) {
                    $i++;
                    //echo "Key: $key; Value: $value\n";
                    echo($key . "=" . $value . "<br />");
                    if ($i == 4) {
                        echo("<br />");

                        $i = 0;
                    }
                }
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            ?>

            <script>
                function uncheckAll() {
                    $('input[type="checkbox"]:checked').prop('checked', false);
                }
                function checkAll() {
                    $('input[type="checkbox"]').prop('checked', true);
                }
            </script>


            <form id="checkform" action="index.php"  method="post">
               <!-- <p> Question name</p> <input type="checkbox" name="vehicle1" value="Bike" onclick= ''>
                
                <input type="submit" name = "submit sellected">
                <input >-->


                <!-- <div class="row">
        <div class="col-md-2 col-md-offset-4">2</div>
        <div class="col-md-2">2</div>
    </div> -->
                <hr >
                <div class ="row" >
                    <div class="col-md-3 col-md-offset-3">
                        <h4 class="text-justify">
                            Question1    g d  fdfdsfsdfsdf ssd f ds sd fsd 
                            f sdf sd fsf dsad asd asda sdas  dasd asd as as sda
                            f sdf sd fsf dsad asd asda sdas 
                            f sdf sd fsf dsad asd asda sdas f sdf sd fsf dsad asd asda sdas 
                            f sdf sd fsf dsad asd asda sdas 

                        </h4>

                    </div>
                    <div class="col-md-3">
                        <label class="switch">
                            <input type="checkbox" id="question1">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>

                <hr >
                <div class ="row" >
                    <div class="col-md-3 col-md-offset-3">
                        <h4 class="text-justify">
                            Question2 dfgh jearsdtf hgsadfghj fds csdf dfgdgdf gdf dgfd fg f  s s sads
                            ds csdf dfgdgdf gdf dgfd fg ds csdf dfgdgdf gdf dgfd fg ds csdf dfgdgdf gdf dgfd fg 
                        </h4>  
                    </div>
                    <div class="col-md-3">
                        <label class="switch">
                            <input type="checkbox" id="question1">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <hr >
                <div class ="row" ></div>
                <div class="col-xs-1 col-xs-offset-3">
                    <input class="btn btn-success active btn-lg" type="submit" value="Apply">
                </div>
            </form> 


            <div class="col-xs-1 col-xs-offset-2 "><div class= "v1">
                    <div class ="row" >
                        <button type="button" class="btn btn-info active btn-lg" onclick="checkAll();">Check All </button>
                    </div>
                    <br />
                    <div class ="row" >
                        <button type="button" class="btn btn-warning active btn-lg " onclick="uncheckAll();">Un-Check All </button>
                    </div> </div>


            </div>
    </body>
</html>


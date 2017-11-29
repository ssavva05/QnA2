<?php

$temptab = filter_input_array(INPUT_POST);
if (empty($temptab)) {
    return header("location:../index.php");
} else {



//setting header to json
    header('Content-Type: application/json');


    $tbl_quest = "question";
    $tbl_ans = "answer";
//print_r($temptab);

    foreach ($temptab as $key => $value) {
        $lid = $value;
    }


    //$stmt = $db->conn->prepare("SELECT textofanswer, counter FROM " . $tbl_ans . " WHERE qid = :quesID ORDER BY qid");
//database
    define('DB_HOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'qnadb');

//get connection
    $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if (!$mysqli) {
        die("Connection failed: " . $mysqli->error);
    }

//query to get data from the table
    $query = sprintf("SELECT textofanswer FROM " . $tbl_quest . " WHERE lid =" . $lid);

//execute query
    $result = $mysqli->query($query);

//loop through the returned data
    /*$data = array();
    foreach ($result as $row) {

        $query2 = sprintf("SELECT count FROM " . $tbl_ans . " WHERE lid =" . $lid . " AND textofanswer=" . $data['textofanswer']);
        $result2 = $mysqli->query($query2);
        $temp = 0;
        $data2 = array();
        foreach ($result2 as $row2) {
            $data2[] = $row2;
            $temp = $data2['count'];
        }

        $temp = $temp / sizeof($result);
        print_r($temp);
        $data[] = $row;
        print_r($data);
    }*/
    
    foreach ($result as $key => $value) {

        print_r($value['textofanswer']);
        $query2 = sprintf("SELECT count FROM " . $tbl_ans . " WHERE lid =" . $lid . " AND textofanswer='" . $value['textofanswer']."'");
        $result2 = $mysqli->query($query2);
        $temp = 0;
        $data2 = array();
        
        print_r($result2);
        foreach ($result2 as $row2) {
            $data2[] = $row2;
            $temp = $data2['count'];
        }

        $temp = $temp / sizeof($result);
        print_r($temp);
        //$data[] = $row;
       // print_r($data);
    }

//free memory associated with result
    $result->close();

//close connection
    $mysqli->close();

    unset($_POST);
//now print the data
    //bridge
    //print json_encode($data);
    //kaleis to consumer to js
}
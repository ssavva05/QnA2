<?php

$temptab = filter_input_array(INPUT_POST);
if (empty($temptab)) {
    return header("location:../index.php");
} else {



//setting header to json
    header('Content-Type: application/json');

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
    $query = sprintf("SELECT playerid, score FROM score ORDER BY playerid");

//execute query
    $result = $mysqli->query($query);

//loop through the returned data
    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }

//free memory associated with result
    $result->close();

//close connection
    $mysqli->close();

    unset($_POST);
//now print the data
    print json_encode($data);
}
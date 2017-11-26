<?php

//DO NOT ECHO ANYTHING ON THIS PAGE OTHER THAN RESPONSE

ob_start();


if (questionID == 0){
    
} 
else{
//Find specific results for each question    
$stmt = $db->conn->prepare("SELECT * FROM " . $tbl_lecture . " WHERE enroll_key = :myenrollkey");
$stmt->bindParam(':myenrollkey', $myenrollkey);
$stmt->execute();
}
// Gets query result
$result = $stmt->fetch(PDO::FETCH_ASSOC);

//modify results if needed to

$resp = $result;
$jsonResp = json_encode($resp);
echo $jsonResp;

unset($resp, $jsonResp);
ob_end_flush();

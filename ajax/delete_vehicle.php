<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

$postjson = file_get_contents('php://input');
$dataArray = json_decode($postjson, true);

// echo "POST: ".$dataArray['id'];
// exit;

require_once '../connect.php';

$sql = "DELETE FROM vehicle 
         WHERE `vehicle`.`id` = ".$dataArray['id'];
// echo $sql;

$result = mysqli_query($link, $sql);

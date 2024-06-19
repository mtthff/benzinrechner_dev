<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once '../connect.php';

$postjson = file_get_contents('php://input');
$dataArray = json_decode($postjson, true);
// echo "POST: ".$dataArray['idVehicle'];
// exit;


// [id] => 1
// [name] => Zafira
// [kennzeichen] => S-RF 2822
// [kmStand] => 143874
// [datum] => 2019-04-12

//  date_format(datum, '%d.%m.%Y') as datum
$sql = "SELECT * FROM `vehicle` WHERE `id` = ".$dataArray['idVehicle']." ORDER BY datum DESC";

// echo $sql;
// exit;

$result = mysqli_query($link, $sql);

$row = mysqli_fetch_assoc($result);

// print_r($row);
// exit;

// Header setzen
header('Content-Type: application/json');

// JSON-Ausgabe
echo json_encode($row);

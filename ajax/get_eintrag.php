<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

$postjson = file_get_contents('php://input');
$dataArray = json_decode($postjson, true);

// echo $dataArray['idEintrag'];
// exit;

require_once '../connect.php';

// $sql = "SELECT *, date_format(datum, '%d.%m.%Y') as datum
$sql = "SELECT *
        FROM consumption 
        WHERE id = ".$dataArray['idEintrag'];
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

// [id] => 12
// [vehicle_id] => 1
// [datum] => 29.05.2024
// [kmStand] => 183775
// [liter] => 48.33
// [preis] => 87.43
// [bemerkung] => Leipzig

echo json_encode($row);
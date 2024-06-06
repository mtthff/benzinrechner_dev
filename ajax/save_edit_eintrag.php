<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL); # & ~E_NOTICE & ~E_WARNING);

require_once '../connect.php';

// echo "<pre>";
// print_r($_POST);
// exit;

// POST
//------
// [id] => 12
// [datum] => 2024-05-29
// [kmStand] => 183775
// [liter] => 48.33
// [preis] => 87.43
// [bemerkung] => Leipzig


$id = mysqli_real_escape_string($link, $_POST['id']);
$datum = mysqli_real_escape_string($link, $_POST['datum']);
$km_stand = mysqli_real_escape_string($link, $_POST['kmStand']);
$liter = mysqli_real_escape_string($link, $_POST['liter']);
$liter = str_replace(',', '.', $liter);
$preis = mysqli_real_escape_string($link, $_POST['preis']);
$preis = str_replace(',', '.', $preis);
$bemerkung = mysqli_real_escape_string($link, $_POST['bemerkung']);

$query = "UPDATE `consumption` SET 
            `datum` = '$datum', 
            `kmStand` = '$km_stand', 
            `liter` = '$liter', 
            `preis` = '$preis', 
            `bemerkung` = '$bemerkung' 
        WHERE `consumption`.`id` = $id"; 

// die($query);

$send = mysqli_query($link, $query);
if (!$send) {
    echo 'Fehler beim Ausführen der Abfrage: ' . mysqli_error($link);
} else {
    header('Location: ../liste.php');
}

<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL); # & ~E_NOTICE & ~E_WARNING);

require_once '../connect.php';

// echo "<pre>";
// print_r($_POST);
// exit;

// POST
//------
// [name] => name
// [kennzeichen] => S-rf 22898
// [kmStand] => 109201
// [datum] => 2024-06-19

$name = mysqli_real_escape_string($link, $_POST['name']);
$kennzeichen = mysqli_real_escape_string($link, $_POST['kennzeichen']);
$kmStand = mysqli_real_escape_string($link, $_POST['kmStand']);
$datum = mysqli_real_escape_string($link, $_POST['datum']);

$query = "INSERT INTO `vehicle`
              VALUES ('', '$name', '$kennzeichen', '$kmStand', '$datum');";

// die($query);
$send = mysqli_query($link, $query);

if (!$send) {
    echo 'Fehler beim Ausführen der Abfrage: ' . mysqli_error($link);
} else {
    header('Location: ../admin.php');
}
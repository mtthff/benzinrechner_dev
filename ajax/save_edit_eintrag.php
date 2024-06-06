<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL); # & ~E_NOTICE & ~E_WARNING);

require_once '../connect.php';


// DATENBANK
//----------
// id INT AUTO_INCREMENT PRIMARY KEY,
// datum DATE,
// kmStand FLOAT,
// liter NUMERIC(5,2),
// preis NUMERIC(6,2),
// bemerkung VARCHAR(255)
//
// INT: Geeignet für die Speicherung von ganzen Zahlen wie Zählungen oder IDs.
// FLOAT: Ideal für Zahlen, die Dezimalstellen wie Messungen oder Berechnungen erfordern.
// NUMERIC: Nützlich für Finanzdaten, bei denen Präzision entscheidend ist.

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
$preis = mysqli_real_escape_string($link, $_POST['preis']);
$bemerkung = mysqli_real_escape_string($link, $_POST['bemerkung']);
$preis = str_replace(',', '.', $preis);

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

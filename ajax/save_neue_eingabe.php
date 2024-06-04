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

// POST
//------
// [vehicle_id] => 1
// [datum] => 2024-06-04
// [kmStand] => 184012
// [liter] => 23.06
// [betrag] => 76.99
// [bemerkung] => neue Eintrag


$vehicle_id = mysqli_real_escape_string($link, $_POST['vehicle_id']);
$datum = mysqli_real_escape_string($link, $_POST['datum']);
$km_stand = mysqli_real_escape_string($link, $_POST['kmStand']);
$liter = mysqli_real_escape_string($link, $_POST['liter']);
$betrag = mysqli_real_escape_string($link, $_POST['betrag']);
$bemerkung = mysqli_real_escape_string($link, $_POST['bemerkung']);
$betrag = str_replace(',', '.', $betrag);

$query = "INSERT INTO `consumption` (`id`, `vehicle_id`, `datum`, `kmStand`, `liter`, `preis`, `bemerkung`) 
              VALUES ('', '$vehicle_id', '$datum', '$km_stand', '$liter', '$betrag', '$bemerkung');";

// die($query);

$send = mysqli_query($link, $query);
if (!$send) {
    echo 'Fehler beim Ausführen der Abfrage: ' . mysqli_error($link);
} else {
    header('Location: ../liste.php');
}


// $stmt = $link->prepare("INSERT INTO consumption (vehicle_id, datum, kmStand, liter, preis, bemerkung) VALUES (?, ?, ?, ?, ?, ?)");
// $stmt->bind_param("isidss", $vehicle_id, $datum, $km_stand, $liter, $betrag, $bemerkung);

// $vehicle_id = $_POST['vehicle_id'];
// $datum = $_POST['datum'];
// $km_stand = $_POST['kmStand'];
// $liter = $_POST['liter'];
// $betrag = str_replace(',', '.', $_POST['betrag']);
// $bemerkung = $_POST['bemerkung'];

// $stmt->execute();
// $stmt->close();

// echo `<!doctype html>
// <html lang="de" data-bs-theme="auto">
// <script>
// alert('Neue Buchung »$bemerkung« wurde gespeichert.');
// window.location='../liste.php';
// </script>`;

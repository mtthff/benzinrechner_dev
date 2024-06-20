<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once '../connect.php';

$sql = "SELECT `id`,`name`,`kennzeichen` 
        FROM `vehicle` 
        WHERE `aktiv` = 'ja'";

$result = mysqli_query($link, $sql);

$kategorien = array();
while ($row = mysqli_fetch_assoc($result)) {
    $kategorien[] = $row;
}

// Header setzen
header('Content-Type: application/json');

// JSON-Ausgabe
echo json_encode($kategorien);

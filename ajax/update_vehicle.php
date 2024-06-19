<?php
ini_set('display;_errors', 'On');
error_reporting(E_ALL); # & ~E_NOTICE & ~E_WARNING);

require_once '../connect.php';

// echo "<pre>";
// print_r($_POST);
// exit;

// POST
//------
// [vehicle_id] => 4
// [name] => namedes Autos
// [kennzeichen] => S-rf 22898
// [kmStand] => 109201
// [datum] => 2024-06-19
// [aktiv] => on

$id = mysqli_real_escape_string($link, $_POST['vehicle_id']);
$name = mysqli_real_escape_string($link, $_POST['name']);
$kennzeichen = mysqli_real_escape_string($link, $_POST['kennzeichen']);
$kmStand = mysqli_real_escape_string($link, $_POST['kmStand']);
$datum = mysqli_real_escape_string($link, $_POST['datum']);
isset($_POST['aktiv']) ? $aktiv = 'ja' : $aktiv = 'nein';

$query = "UPDATE `vehicle` SET 
            `name` = '$name', 
            `kennzeichen` = '$kennzeichen', 
            `kmStand` = '$kmStand',
            `datum` = '$datum',
            `aktiv` = '$aktiv'
         WHERE `vehicle`.`id` = " . $id;
// echo $query;
$send = mysqli_query($link, $query);

header('Location: ../admin.php');

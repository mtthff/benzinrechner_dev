<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL); # & ~E_NOTICE & ~E_WARNING);

require_once 'connect.php';

$dataVehicle = array();
$sqlVehicle = 'SELECT * FROM `vehicle` ORDER BY id ASC';
$resultVehicle = mysqli_query($link, $sqlVehicle);
while ($rowVehicle = mysqli_fetch_assoc($resultVehicle)) {
    $dataVehicle[] = $rowVehicle; // Fügt jeden Datensatz zum Array hinzu
}
// echo "<pre>";
// print_r($dataVehicle);
// exit;
// [id] => 1
// [name] => Zafira
// [kennzeichen] => S-RF 2822
// [kmStand] => 143874
// [datum] => 2019-04-12


?>

<!doctype html>
<html lang="de" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Matthias Hoffmann">
    <title>Benzinrechner · v24.6</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <!-- <meta name="theme-color" content="#712cf9"> -->

</head>

<body>

    <main class="container">
        <div class="bg-body-tertiary pt-1 px-3 pb-5 rounded mt-3">
            <div class="my-3 row">
                <h1 class="col">Admin</h1>
                <div class="col">
                    <button type="button" class="btn btn-primary float-end" id="newVehicle">Neues Auto</button>
                </div>
            </div>

            <div class="table-responsive mb-3">
                <table class="table">
                    <thead>
                        <tr class="table-info">
                            <th scope="col">id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Kennzeichen</th>
                            <th scope="col">Kilometerstand</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="listeKategorien">
                        <?php
                        foreach ($dataVehicle as $key => $value) {
                            echo <<<HTML
                                <tr data-id="{$value['id']}">
                                    <td>{$value['id']}</td>
                                    <td>{$value['name']}</td>
                                    <td>{$value['kennzeichen']}</td>
                                    <td>{$value['kmStand']}</td>
                                    <td><img src="assets/img/edit_24dp.svg" class="editVehicle" data-id="{$value['id']}" alt="edit"></td>
                                </tr>
                            HTML;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- Modal -->
    <div class="modal fade" id="vehicleModal" tabindex="-1" aria-labelledby="vehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="vehicleModalLabel">...</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="formVehicle">
                    <input type="hidden" name="vehicle_id" id="IdVehicle">
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Name</span>
                            <input type="text" class="form-control" name="name" id="name" autocomplete="off" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Kennzeichen</span>
                            <input type="text" class="form-control" name="kennzeichen" id="kennzeichen" autocomplete="off" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">KM-Stand</span>
                            <input type="number" class="form-control" name="kmStand" id="kmStand" autocomplete="off" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Startdatum</span>
                            <input type="date" class="form-control" name="datum" id="datum" autocomplete="off" required>
                        </div>
                        <div class="form-check form-switch" id="switchVehicleAktiv">
                            <input class="form-check-input" type="checkbox" role="switch" name="aktiv" id="vehicleAktiv" disabled>
                            <label class="form-check-label" for="vehicleAktiv">Auto deaktivieren</label>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="deleteVehicle" disabled>Auto löschen</button>
                            <button type="submit" class="btn btn-primary" id="submitForm"></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <nav class="navbar fixed-bottom navbar-expand navbar-dark bg-secondary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link active" aria-current="page" href="index.php">
                            <img src="assets/img/local_gas_station_48dp.svg" alt="Eingabe">
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="liste.php">
                            <img src="assets/img/list_alt_48dp.svg" alt="Liste">
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">
                            <img src="assets/img/manufacturing_48dp.svg" alt="Suche">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="assets/js/frameworks/bootstrap.min.js"></script>
    <script src="assets/js/admin.js"></script>

</body>

</html>
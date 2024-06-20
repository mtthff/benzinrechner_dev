<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL); # & ~E_NOTICE & ~E_WARNING);

require_once 'connect.php';

// Maxmimaler kmStand aus Datenbank auslesen
$sqlMax_kmStand = 'SELECT MAX(kmStand) AS max_kmStand FROM consumption;';
$max_kmStand_handle = mysqli_query($link, $sqlMax_kmStand);
$dataMax_kmStand = mysqli_fetch_assoc($max_kmStand_handle);

// $data = array("max_kmStand" => $dataMax_kmStand['max_kmStand']);
// $json_data = json_encode($data); // Daten in JSON umwandeln

// $file = 'assets/data/data_max_km_stand.json';
// file_put_contents($file, $json_data); // JSON-Daten in eine Datei schreiben

?>
<!doctype html>
<html lang="de" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Matthias Hoffmann">
    <title>Benzinrechner · v0.24.6</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <!-- <meta name="theme-color" content="#712cf9"> -->

</head>

<body>

    <main class="container">
        <div class="bg-body-tertiary px-3 rounded mt-3">

            <form action="ajax/save_neue_eingabe.php" method="post">
                <div class="my-3 row">
                    <span class="h1 col">Benzinrechner</span>
                    <select class="form-select col" aria-label="Default select selectAuto" name="vehicle_id" id="vehicle">
                        <option selected disabled value="">Bitte Fahrzeug wählen</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="datum">Datum</span>
                    <input type="date" class="form-control" name="datum" aria-label="datum" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">km-Stand</span>
                    <input type="number" class="form-control" name="kmStand" aria-label="kmStand" step="1" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Liter</span>
                    <input type="number" class="form-control" name="liter" aria-label="liter" step="0.01" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">€</span>
                    <input type="number" class="form-control" name="betrag" aria-label="betrag" step="0.01" required>
                </div>
                <div class="input-group mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="ja" name="vollgetankt" id="vollgetankt" checked>
                        <label class="form-check-label" for="vollgetankt">vollgetankt</label>
                    </div>
                </div>
                <div class="table-responsive col-sm-12 col-lg-5">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Literpreis</th>
                                <td id="literPreis"></td>
                            </tr>
                            <tr>
                                <th scope="row">gefahrene km</th>
                                <td id="gefahreneKm"></td>
                            </tr>
                            <tr>
                                <th scope="row">Verbrauch/ 100 km</th>
                                <td id="verbrauch"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="text">Bemerkung</span>
                    <input type="text" class="form-control" name="bemerkung" placeholder="Bemerkung" aria-label="bemerkung" aria-describedby="basic-addon1">
                </div>
                <button type="reset" class="btn btn-md btn-primary mb-5" href="#" role="button">abbrechen</button>
                <button type="submit" class="btn btn-md btn-primary mb-5" href="#" role="button">speichern</button>
            </form>

        </div>
    </main>



    <nav class="navbar fixed-bottom navbar-expand navbar-dark bg-secondary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link active" aria-current="page" href="#">
                            <img src="assets/img/local_gas_station_48dp.svg" alt="Eingabe">
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="liste.php">
                            <img src="assets/img/list_alt_48dp.svg" alt="Liste">
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="admin.php">
                            <img src="assets/img/manufacturing_48dp.svg" alt="Suche">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="assets/js/frameworks/bootstrap.min.js"></script>
    <script>
        kmStandAlt = <?php echo $dataMax_kmStand['max_kmStand']; ?>
    </script>
    <script src="assets/js/main.js"></script>

</body>

</html>
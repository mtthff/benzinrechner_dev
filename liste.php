<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL); # & ~E_NOTICE & ~E_WARNING);

require_once 'connect.php';

$sqlVehicle = 'SELECT * FROM `vehicle` ORDER BY datum ASC';
$resultVehicle = mysqli_query($link, $sqlVehicle);
$dataVehicle = mysqli_fetch_assoc($resultVehicle);
// echo "<pre>";
// print_r($dataVehicle);
// exit;
//     [id] => 1
//     [name] => Zafira
//     [kennzeichen] => S-RF 2822
//     [kmStand] => 143874
//     [datum] => 2019-04-12


$sql = "SELECT * FROM consumption ORDER BY datum ASC";
$result = mysqli_query($link, $sql);

$dataConsumption[] = array(
    'id' => '',
    'datum' => '',
    'kmStand' => $dataVehicle['kmStand'],
    'liter' => '',
    'preis' => '',
    'literPreis' => '',
    'gefahreneKm' => 1,
    'verbrauch' => '',
    'bemerkung' => ''
);
$lastKey = array_key_last($dataConsumption);

while ($row = mysqli_fetch_assoc($result)) {
    $dataConsumption[] = array(
        'id' => $row['id'],
        'datum' => $row['datum'],
        'kmStand' => $row['kmStand'],
        'liter' => $row['liter'],
        'preis' => $row['preis'],
        'literPreis' => round($row['preis'] / $row['liter'], 2),
        'gefahreneKm' => $row['kmStand'] - $dataConsumption[$lastKey]['kmStand'],
        'verbrauch' => round($row['liter'] / (($row['kmStand'] - $dataConsumption[$lastKey]['kmStand']) / 100), 2),
        'bemerkung' => $row['bemerkung']
    );
    $lastKey = array_key_last($dataConsumption);
    if ($dataConsumption[$lastKey]['gefahreneKm'] > 1000 or $dataConsumption[$lastKey]['gefahreneKm'] < 0) {
        $dataConsumption[$lastKey]['gefahreneKm'] = '-';
        $dataConsumption[$lastKey]['verbrauch'] = '-';
    }
}
array_shift($dataConsumption);
// echo "<pre>";
// print_r($dataConsumption);
// exit;

?>
<!doctype html>
<html lang="de" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Matthias Hoffmann">
    <title>Haushaltsbuch · v24.5 (template)</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <!-- <meta name="theme-color" content="#712cf9"> -->

</head>

<body>

    <!-- Tabelle -->
    <main class="container">
        <div class="bg-body-tertiary pt-1 px-3 pb-5 rounded mt-3 mb-5">
            <div class="my-3 row">
                <span class="h1 col">Liste</span>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Datum</th>
                            <th scope="col">km-Stand</th>
                            <th scope="col">Liter</th>
                            <th scope="col">Preis</th>
                            <th scope="col">Literpreis</th>
                            <th scope="col">gefahrene km</th>
                            <th scope="col">Verbrauch</th>
                            <th scope="col">Bemerkung</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        end($dataConsumption); // Setzt den Zeiger auf das letzte Element des Arrays
                        while (key($dataConsumption) !== null) {
                            $key = key($dataConsumption);
                            $value = current($dataConsumption);
                        ?>
                            <tr>
                                <th scope="row"><?php echo date('d.m.y', strtotime($value['datum'])) ?></th>
                                <td><?php echo number_format($value['kmStand'], 0, ',', '.') ?> km</td>
                                <td><?php echo str_replace('.', ',', $value['liter']) ?> l</td>
                                <td><?php echo str_replace('.', ',', $value['preis']) ?> €</td>
                                <td><?php echo str_replace('.', ',', $value['literPreis']) ?> €</td>
                                <td><?php echo ($value['gefahreneKm'] != '-') ? $value['gefahreneKm'] . ' km' : '-' ?></td>
                                <td><?php echo ($value['verbrauch'] != '-') ? $value['verbrauch'] . ' l' : '-' ?></td>
                                <td><?php echo $value['bemerkung'] ?></td>
                                <td><img class="editEintrag" data-id="<?php echo $value['id'] ?>" src="assets/img/edit_24dp.svg" alt="edit"></td>
                            </tr>
                        <?php
                            prev($dataConsumption); // Bewegt den Zeiger auf das vorherige Element
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Eintrage bearbeiten</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="ajax/save_edit_eintrag.php" method="post">
                    <input type="hidden" name="id" id="id">
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Datum</span>
                            <input type="date" class="form-control" name="datum" id="datum" aria-label="datum" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">km-Stand</span>
                            <input type="number" class="form-control" name="kmStand" id="kmStand" aria-label="kmStand" step="0.01" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Liter</span>
                            <input type="number" class="form-control" name="liter" id="liter" aria-label="liter" step="0.01" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">€</span>
                            <input type="number" class="form-control" name="preis" id="preis" aria-label="preis" step="0.01" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="ja" name="vollgetankt" id="vollgetankt">
                                <label class="form-check-label" for="vollgetankt">vollgetankt</label>
                            </div>
                        </div>
                        <div class="input-group mt-4 mb-3">
                            <span class="input-group-text">Bemerkung</span>
                            <input type="text" class="form-control" name="bemerkung" id="bemerkung" placeholder="Bemerkung" aria-label="bemerkung" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Änderungen speichern</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Navigation -->
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
                        <a class="nav-link" href="#">
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
    <script src="assets/js/liste.js"></script>
</body>

</html>
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL); # & ~E_NOTICE & ~E_WARNING);

require_once 'connect.php';
$sql = "SELECT * FROM consumption ORDER BY datum ASC";
$result = mysqli_query($link, $sql);

$data[] = array(
    'id' => '',
    'datum' => '',
    'kmStand' => 0,
    'liter' => '',
    'preis' => '',
    'literPreis' => '',
    'gefahreneKm' => 1,
    'verbrauch' => '',
    'bemerkung' => ''
);
$lastKey = array_key_last($data);
// echo "<pre>";
// print_r($data);
// echo $lastKey;
// exit;

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array(
        'id' => $row['id'],
        'datum' => $row['datum'],
        'kmStand' => $row['kmStand'],
        'liter' => $row['liter'],
        'preis' => $row['preis'],
        'literPreis' => round($row['preis'] / $row['liter'], 2),
        'gefahreneKm' => $row['kmStand'] - $data[$lastKey]['kmStand'],
        'verbrauch' => round($row['liter'] / (($row['kmStand'] - $data[$lastKey]['kmStand']) / 100), 2),
        'bemerkung' => $row['bemerkung']
    );
    $lastKey = array_key_last($data);
}
array_shift($data);
// echo "<pre>";
// print_r($data);
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

    <main class="container">
        <div class="bg-body-tertiary p-3 rounded mt-3 mb-5">
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $key => $value) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $value['datum'] ?></th>
                                <td><?php echo $value['kmStand'] ?></td>
                                <td><?php echo $value['liter'] ?></td>
                                <td><?php echo $value['preis'] ?> €</td>
                                <td><?php echo $value['literPreis'] ?> €</td>
                                <td><?php echo $value['gefahreneKm'] ?> km</td>
                                <td><?php echo $value['verbrauch'] ?> l</td>
                                <td><?php echo $value['bemerkung'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <nav class="navbar fixed-bottom navbar-expand navbar-dark bg-dark">
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
                            <img src="assets/img/manufacturing_48db.svg" alt="Suche">
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
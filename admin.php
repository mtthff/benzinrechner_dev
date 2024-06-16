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
    <style>


    </style>

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
                        <tbody id="listeKategorien"></tbody>
                    </table>
                </div>
            </div>

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
    <script src="assets/js/main.js"></script>

</body>

</html>
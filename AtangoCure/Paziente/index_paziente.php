<?php 
$titre ="Home";
    include("../Headers/Header_pazienti.php");
?>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index_paziente.php"><img src="../logo/AtangoCure 1.jpg" class="rounded-circle" alt="Logo" width="90" height="70"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
                <li class="nav-item active">
                    <a class="nav-link" href="prenotazione.php">Nuova Prenotazione <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="EsitiPazienti.php">Esiti</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="profilo.php">Profilo</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="prenotazioniEffettuate.php">prenotazioni Effettuate</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">Benvenuto nella clinica AtangoCure!</h1>
            <div class="btn btn-warning btn-lg btn-block mb-2">
                <p>la cura dei pazienti è la nostra priorità</p>
            </div>
            <h4>usare le voci in alto per consultare lo stato delle visite con i rispettivi pazienti</h4>
        </div>
    </div>
<?php
    include("../Footer.php");
?>

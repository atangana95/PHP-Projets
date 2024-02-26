<?php 
$titre ="visite giornaliere";
    include("../Headers/Header_medici.php");
    include("../config.php");

?>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index_Medico.php"><img src="../logo/AtangoCure 1.jpg" class="rounded-circle" alt="Logo" width="90" height="70"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
                <li class="nav-item active">
                    <a class="nav-link" href="Esiti.php">Esiti</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="profilo.php">Profilo</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="appuntamenti.Settimanali.php">appuntamenti settimanali</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="visiteEffettuate.php">visite effettuate</a>
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
    <h2>visite giornaliere da effettuare</h2>
    <?php
        $visitaG = $database->prepare("SELECT Pre.descrizione, Pre.data_visita, Pre.ora_visita, paz.nome, paz.cognome FROM $tabellaPrenotazioni as Pre, $tabellaPazienti as paz WHERE Pre.id_medico = ? AND Pre.effettuata = ? AND Pre.data_visita < NOW() AND paz.id_paziente= paz.ID_paziente");
        $visitaG->execute(array($_SESSION['utente_id'],'non ancora'));
        if($visitaG->rowCount()>0){ 
    ?>
    <table class="table-bordered table-secondary mt-2 border-3 border-warning">
        <thead>
            <tr>
                <th scope="col">descrizione</th>
                <th scope="col">data visita</th>
                <th scope="col">ora visita</th>
                <th scope="col">nome paziente</th>
                <th scope="col">cognome paziente</th>
            </tr>
        </thead>
        <tbody>
        <?php   
            while($DatiVisitaG = $visitaG->fetch()){
                $descrizione= $DatiVisitaG['descrizione'];
                $data = $DatiVisitaG['data_visita'];
                $ora = $DatiVisitaG['ora_visita'];
                $NomePaziente = $DatiVisitaG['nome'];
                $CognomePaziente = $DatiVisitaG['cognome'];
        ?>
            <tr>
                <td><?=$descrizione ?></td>
                <td><?=$data ?></td>
                <td><?=$ora ?></td>
                <td><?=$NomePaziente ?></td>
                <td><?=$CognomePaziente ?></td>
            </tr>
    <?php   
            }
        }else{
            echo "<p>per oggi non ci sono visite da effettuare ai pazienti</p>";
        }   
    ?>
        </tbody>
    </table>
<?php
    include("../Footer.php");
?>

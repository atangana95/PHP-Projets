<?php 
$titre ="Prenotazione";
    include("../Headers/Header_pazienti.php");
    include("../config.php");
?>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index_paziente.php"><img src="../logo/AtangoCure 1.jpg" class="rounded-circle" alt="Logo" width="90" height="70"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <b class="navbar-toggler-icon"></b>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
                <li class="nav-item active">
                    <a class="nav-link" href="EsitiPazienti.php">Esiti</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="profilo.php">Profilo</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav> 
    <h3>Visite da effettuare</h3>
    <?php 
        $preno = $database->prepare("SELECT P.descrizione, P.data_visita, P.ora_visita, M.nome, M.cognome FROM $tabellaPrenotazioni as P, $tabellaMedici as M WHERE P.id_paziente = ? AND P.effettuata = ? AND P.id_medico= M.ID_medico");
        $preno->execute(array($_SESSION['utente_id'],'non ancora'));
        if($preno->rowCount()>0){ ?>
            <table class="table-bordered table-secondary mt-2 border-3 border-warning">
                <thead>
                    <tr>
                        <th scope="col">descrizione</th>
                        <th scope="col">data visita</th>
                        <th scope="col">ora visita</th>
                        <th scope="col">nome medico</th>
                        <th scope="col">cognome medico</th>
                    </tr>
                </thead>
            <tbody>
    <?php   while($Datipreno = $preno->fetch()){
            $descrizione= $Datipreno['descrizione'];
            $data = $Datipreno['data_visita'];
            $ora = $Datipreno['ora_visita'];
            $NomeMedico = $Datipreno['nome'];
            $CognomeMedico = $Datipreno['cognome'];
    ?>
            <tr>
                <td><?=$descrizione ?></td>
                <td><?=$data ?></td>
                <td><?=$ora ?></td>
                <td><?=$NomeMedico ?></td>
                <td><?=$CognomeMedico ?></td>
            </tr>
            <?php 
            }
        }else{
            echo "<p>trovato 0 visita da effettuatare</p>";
        }
        ?>
        </tbody>
    </table>
    <h3>Visite effettuate</h3>
    <?php 
        $preno = $database->prepare("SELECT P.descrizione, P.data_visita, P.ora_visita, M.nome, M.cognome FROM $tabellaPrenotazioni as P, $tabellaMedici as M WHERE P.id_paziente = ? AND P.effettuata = ? AND P.data_visita < NOW() AND P.id_medico= M.ID_medico");
        $preno->execute(array($_SESSION['utente_id'],'effettuata'));
        if($preno->rowCount()>0){ ?>
            <table class="table-bordered table-secondary mt-2 border-3 border-warning">
                <thead>
                    <tr>
                        <th scope="col">descrizione</th>
                        <th scope="col">data visita</th>
                        <th scope="col">ora visita</th>
                        <th scope="col">nome medico</th>
                        <th scope="col">cognome medico</th>
                    </tr>
                </thead>
            <tbody>
    <?php             while($Datipreno = $preno->fetch()){
            $descrizione= $Datipreno['descrizione'];
            $data = $Datipreno['data_visita'];
            $ora = $Datipreno['ora_visita'];
            $NomeMedico = $Datipreno['nome'];
            $CognomeMedico = $Datipreno['cognome'];
    ?>
            <tr>
                <td><?=$descrizione ?></td>
                <td><?=$data ?></td>
                <td><?=$ora ?></td>
                <td><?=$NomeMedico ?></td>
                <td><?=$CognomeMedico ?></td>
            </tr>
            <?php 
            }
        }else{
            echo "<p>trovato 0 visita effettuata</p>";
        }
        ?>
        </tbody>
    </table>
    <h3>Visite mancate</h3>
    
    <?php 
        $preno = $database->prepare("SELECT P.descrizione, P.data_visita, P.ora_visita, M.nome, M.cognome FROM $tabellaPrenotazioni as P, $tabellaMedici as M WHERE P.id_paziente = ? AND P.effettuata = ? AND P.data_visita < NOW() AND P.id_medico= M.ID_medico");
        $preno->execute(array($_SESSION['utente_id'],'mancata'));
        if($preno->rowCount()>0){ ?>
            <table class="table-bordered table-secondary mt-2 border-3 border-warning">
                <thead>
                    <tr>
                        <th scope="col">descrizione</th>
                        <th scope="col">data visita</th>
                        <th scope="col">ora visita</th>
                        <th scope="col">nome medico</th>
                        <th scope="col">cognome medico</th>
                    </tr>
                </thead>
            <tbody>
    <?php    while($Datipreno = $preno->fetch()){
            $descrizione= $Datipreno['descrizione'];
            $data = $Datipreno['data_visita'];
            $ora = $Datipreno['ora_visita'];
            $NomeMedico = $Datipreno['nome'];
            $CognomeMedico = $Datipreno['cognome'];
    ?>
            <tr>
                <td><?=$descrizione ?></td>
                <td><?=$data ?></td>
                <td><?=$ora ?></td>
                <td><?=$NomeMedico ?></td>
                <td><?=$CognomeMedico ?></td>
            </tr>
            <?php 
            }
        }else{
            echo "<p>trovato 0 visita effettuata</p>";
        }
        ?>
        </tbody>
    </table>
<?php
    include("../Footer.php");
?>
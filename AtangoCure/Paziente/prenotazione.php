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
                <a class="nav-link" href="prenotazioniEffettuate.php">prenotazioni Effettuate</a>
            </li>
            </ul>
        </div>
    </nav>
    <script>
        function ConvalidaForm() {
            let codice_fis = document.forms["DatiPrestazione"]["codice_fiscale"].value;
            let nome = document.forms["DatiPrestazione"]["nome"].value;
            let cognome = document.forms["DatiPrestazione"]["cognome"];
            let data = document.forms["DatiPrestazione"]["DataVisita"];
            let ora = document.forms["DatiPrestazione"]["OraVisita"];
            let prestazione = document.forms["DatiPrestazione"]["prestazioni"];
            if (codice_fis == "" || nome=="" || data=="" || ora=="" || prestazione=="") {
                alert("compila tutti i campi prima di inviare");
                return false;
            }
        }
    </script>
    <form action="pagamento.php" method="post" name="DatiPrestazione" onsubmit="return ConvalidaForm()">
        <h3 class="mt-5">inserisci i tuoi dati</h3>
        <div class="mb-3">
            <label >codice fiscale</label>
            <input type="text"  name="codice_fiscale" value="<?php if(isset($_POST['codice_fiscale'])){echo $_POST['codice_fiscale'];}?>" style="width:80%;" />
            <span class="text-danger">* </span>
        </div>
        <div class="mb-3" >
            <label>nome : </label>
            <input type="text" name="nome" value="<?php if(isset($_POST['nome'])){echo $_POST['nome'];}?>" style="width:80%;"/>
            <span class="text-danger">*</span>
        </div>
        <div class="mb-3">
            <label>cognome : </label>
            <input type="text" name="cognome" value="<?php if(isset($_POST['cognome'])){echo $_POST['cognome'];}?>" style="width:80%;"/>
            <span class="text-danger">* </span>
        </div>
        <p ><h3 class="text-center">Inserisci i dati della visita che desideri</h3></p>
        <div class="mb-3">
            <label>data visita : </label>
            <input type="date" name="DataVisita" value="<?php if(isset($_POST['DataVisita'])){echo $_POST['DataVisita'];}?>" />
            <span class="text-danger">*</span>        
        </div>
        <div class="mb-3">
            <label>ora visita : </label>
            <input type="time"  name="OraVisita" value="<?php if(isset($_POST['OraVisita'])){echo $_POST['OraVisita'];}?>"/>
            <span class="text-danger">* </span>
        </div>
        <div class=" mb-3 mr-3">
            <label for="prestazioni"> scegli prestazione: </label>
            <select name="prestazioni" >
            <?php 
                $spresta = $database->query("SELECT * FROM $tabellaPrestazioni");
                if($spresta->rowCount()>0){
                    while($Dati = $spresta->fetch()){
                        $descrizione = $Dati['descrizione']; 
                        $medico=  $Dati['specialista'];
                        $medi= explode(" ", $Dati['specialista']);
                        $durata = $Dati['durata'];
                        $costo = $Dati['costo'];
                        $value =array(0=>$descrizione, 1=>$medi[0],2=>$medi[1]);
                        ?>
                        <option value="<?php print_r($Dati['ID_prestazione']) ?>"><b><?=$descrizione ?> medico: <?=$medico ?> durata: <?=$durata ?> costo: <?=$costo ?></b></option>

                <?php         }
                            }
                        ?> 
            </select> 
            <span class="text-danger">* </span>
            <button type="submit" class="btn btn-primary" name="invio">Invia</button>
        </div>
    </form>
<?php
    include("../Footer.php");
?>
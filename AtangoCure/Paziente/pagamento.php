<?php
    $titre ="Pagamento prenotazione";
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
        </div>
    </nav>
    <?php

        if(isset($_POST['invio'])){
            $codice_fisc = htmlspecialchars($_POST['codice_fiscale']);
            $cognome=htmlspecialchars($_POST['cognome']);
            $nome=htmlspecialchars($_POST['nome']);
            $DataVisita = htmlspecialchars($_POST['DataVisita']);
            $OraVisita = htmlspecialchars($_POST['OraVisita']);
            $ID_prestazione=htmlspecialchars($_POST['prestazioni']);
            $Datipresta = $database->prepare("SELECT * FROM $tabellaPrestazioni WHERE ID_prestazione=?");
            $Datipresta->execute(array($ID_prestazione));
            if($Datipresta->rowCount()>0){
                $Datipres = $Datipresta->fetch();
                $DatiMedico= explode(" ", $Datipres['specialista']);
                $name = $DatiMedico[0];
                $surname = $DatiMedico[1];
                $descr_preno = $Datipres['descrizione'];
            }
        }
    ?>
    <h3>dati della prestazione scelta</h3>
    <table class="table-bordered table-secondary mt-2 border-3 border-warning">
        <thead>
            <tr>
                <th scope="col">descrizione</th>
                <th scope="col">nome medico</th>
                <th scope="col">cognome medoco</th>
                <th scope="col">durata</th>
                <th scope="col">costo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?=$Datipres['descrizione'] ?></td>
                <td><?=$name ?></td>
                <td><?=$surname ?></td>
                <td><?=$Datipres['durata'].'h' ?></td>
                <td><?='€'.$Datipres['costo'] ?></td>
            </tr>
        </tbody>
    </table>
    <h3 class="mt-5">procedi al pagamento</h3>
    <div class=" mb-3 mr-3">
        <label for="prestazioni"> scegli tipo di carta: </label>
        <select name="prestazioni" >
        <?php 
            $pagamento = $database->query("SELECT * FROM $tabellaTipiCC");
            if($pagamento->rowCount()>0){
                while($Dati = $pagamento->fetch()){
                    $descrizione = $Dati['descrizione']; 
                    $osservazioni=  $Dati['osservazioni'];
        ?>
        <option value="<?php print_r($Dati['descrizione']) ?>"><b><?=$descrizione ?></b></option>
        <?php       }
                }
            ?> 
        </select> 
    </div>
    <script type="text/javascript">
        function ConvalidaForm() {
            let nometit = document.forms["DatiCarta"]["nometit"].value;
            let cognometit = document.forms["DatiCarta"]["cognometit"];
            let numero = document.forms["DatiCarta"]["numero"];
            let cvc = document.forms["DatiCarta"]["cvc"];
            if ( nometit=="" || cognometit=="" || numero=="" || cvc=="") {
                alert("compila tutti i campi prima di inviare");
                return false;
            }elseif(numero.lenght != 16){
                alert("il numero della carta deve essere fatto di 16 ciffre!");
                return false;
            }elseif(cvc.lenght != 3){
                alert("il cvc della carta deve essere fatto di 3 ciffre!");
                return false;
            }else{
                alert("prenotazione effettuata con successo!");
                return true;
            }
        }
        function OnclickConferma(){
            alert("prenotazione effettuata con successo!");
            window.setTimeout(function() {
                window.location.href="prenotazioniEffettuate.php";
            }, 5000);
        }
    </script>
    <h4>dati della carta</h4>
    <form action="confermaPagamento.php" name="DatiCarta" method="post" onsubmit="return ConvalidaForm()">
        <div class="mb-3" >
                <label>nome cognome del titolare della carta : </label>
                <input type="text" name="nometit" value="<?php if(isset($_POST['nometit'])){echo $_POST['nometit'];}?>" style="width:80%;"/>
                <span class="text-danger">*</span>
        </div>
        <div class="mb-3">
                <label>cognome del titolare: </label>
                <input type="text" name="cognometit" value="<?php if(isset($_POST['cognometit'])){echo $_POST['cognometit'];}?>" style="width:80%;"/>
                <span class="text-danger">* </span>
            </div>
            <div class="mb-3">
                <label for="quantity">numero carta : 16 numeri attesi </label>
                <input type="number" id="quantity" name="numero" value="<?php if(isset($_POST['numero'])){echo $_POST['numero'];}?>" style="width:80%;"/>
                <span class="text-danger">* </span>
            </div>
            <div class="mb-3">
                <label>CVC : 3 numeri attesi</label>
                <input type="number" name="cvc" value="<?php if(isset($_POST['cvc'])){echo $_POST['cvc'];}?>" style="width:80%;"/>
                <span class="text-danger">* </span>
                <input type="hidden" name="NewNome" value="<?=$name ?>" />
                <input type="hidden" name="NewCognome" value="<?=$surname ?>" />
                <input type="hidden" name="Newdescr_preno" value="<?=$descr_preno ?>" />
                <input type="hidden" name="NewDataVisita" value="<?=$DataVisita ?>" />
                <input type="hidden" name="NewOraVisita" value="<?=$OraVisita ?>" />
                <input type="hidden" name="Newcodice_fisc" value="<?=$codice_fisc ?>" />
            </div>
        <button type="submit" class="btn btn-primary" name="pagamento">Paga ora</button>
    </form>
<?php
    include("../Footer.php");
?>
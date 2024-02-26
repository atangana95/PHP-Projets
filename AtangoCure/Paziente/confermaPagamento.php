<?php
    $titre ="Conferma pagamento";
    include("../Headers/Header_pazienti.php");
    include("../config.php");
?>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index_paziente.php"><img src="../logo/AtangoCure 1.jpg" class="rounded-circle" alt="Logo" width="90" height="70"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <b class="navbar-toggler-icon"></b>
        </button>
    </nav>
    <?php
    include("../Footer.php");
    if(isset($_POST['pagamento'])){
        $name =$_POST['NewNome'];
        $surname=$_POST['NewCognome'];
        $descr_preno = $_POST['Newdescr_preno'];
        $DataVisita= $_POST['NewDataVisita'];
        $OraVisita = $_POST['NewOraVisita'];
        $codice_fisc = $_POST['Newcodice_fisc'];
        $sql = "SELECT ID_medico, cod_specia FROM $tabellaMedici WHERE  nome = ? AND cognome=?";
        $DatiUtente =$database->prepare($sql);
        $DatiUtente->execute(array($name, $surname));
        if($DatiUtente->rowCount()>0){
            $risultati = $DatiUtente->fetch();
        }
        $id_medico = $risultati[0];
        $cod_specia = $risultati[1];
        $sql1 = "SELECT ID_paziente FROM $tabellaPazienti WHERE  codice_fiscale = ?";
        $DatiU =$database->prepare($sql1);
        $DatiU->execute(array($codice_fisc));
        if($DatiU->rowCount()>0){
            $risult = $DatiU->fetch();
        }
        $id_paziente = $risult[0];
        $data_prenotazione = date("m-d-y");
        if(!empty($_POST['nometit']) && !empty($_POST['cognometit']) && !empty($_POST['numero']) && !empty($_POST['cvc'])){
            $nometit=$_POST['nometit'];
            $cognometit=$_POST['cognometit'];
            $numero=$_POST['numero'];
            $cvc=$_POST['cvc'];   
            $preno = $database->prepare("INSERT INTO $tabellaPrenotazioni(descrizione,id_medico,cod_specia,id_paziente,data_prenotazione,data_visita,ora_visita)VALUES (?,?,?,?,?,?,?)");
            if ($preno->execute(array($descr_preno,$id_medico,$cod_specia,$id_paziente,$data_prenotazione,$DataVisita,$OraVisita)))
            echo 'caro '.$_SESSION['nome'].' '.$_SESSION['cognome'].' la sua prenotazione è terminata con successo!' ;
            header( "refresh:5000;URL=prenotazioniEffettuate.php" );
        }
    }
?>

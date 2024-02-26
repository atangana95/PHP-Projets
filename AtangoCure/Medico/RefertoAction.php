<?php 
    $titre ="Inserzione referto";
    include("../Headers/Header_medici.php");
    include("../config.php");
    if(isset($_POST['invio'])){
        if(!empty($_POST['referto'])){
            $prenotazione = $_POST['prenotazione'];
            $visitaG = $database->prepare("SELECT * FROM $tabellaPrenotazioni WHERE ID_prenotazione=?");
            $visitaG->execute(array($prenotazione));
            if($visitaG->rowCount()>0){
                while($DatiVisitaG = $visitaG->fetch()){
                    $descrizione= $DatiVisitaG['descrizione'];
                    $ID_prenotazione=$DatiVisitaG['ID_prenotazione'];
                    $data=$DatiVisitaG['data_visita'];
                }
            }
            $referto=$_POST['referto'];
            $visita = "INSERT INTO $tabellaVisite (descrizione, id_prenotazione, data_visita, referto) VALUES ('$descrizione','$ID_prenotazione','$data','$referto')";
            $database->exec($visita);
            //una volta inserita la visita, cancella la prenotazione
            $Cancella = $database->prepare("DELETE FROM $tabellaPrenotazioni WHERE id_prenotazione=?");
            $Cancella->execute(array($ID_prenotazione));
            header("Location: visiteEffettuate.php");
        }
        
    }
?>

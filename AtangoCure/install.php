<?php
    $server="mysql:host=localhost";
    $tabellaMedici = "Medici";
    $tabellaPazienti = "Pazienti";
    $tabellaVisite = "Visite";
    $tabellaSpecializzazioni = "Specializzazioni";
    $tabellaMediciSpecializzazioni = "Medici_Specializzazioni";
    $tabellaGeneri = "Generi";
    $tabellaPrenotazioni = "Prenotazioni";
    $tabellaTipiCC = "TipiCC";
    $tabellaPrestazioni = "Prestazioni";
    $user = "root";
    $passw = "";
    $dbName = 'mysql:host=localhost';
    $database =  new PDO($dbName,$user,$passw);
    
    $sql = "CREATE DATABASE IF NOT EXISTS AtangoCure";
    $database->exec($sql);
    echo "Database creato <br>";
    $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
    $database1 =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    $queryPaz = "CREATE TABLE IF NOT EXISTS $tabellaPazienti ( 
        ID_paziente INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        codice_fiscale varchar(16) NOT NULL,
        cognome varchar(30)	 NOT NULL,
        nome varchar(30)	 NOT NULL,
        email varchar(25)	 NOT NULL,
        password varchar(14) NOT NULL,
        indirizzo varchar(60) NOT NULL,
        numero_civico varchar(4) NOT NULL,
        cap INT NOT NULL,
        telefono varchar(10) NOT NULL,
        fax varchar(10) NOT NULL
     )";
     try{

        $database1->exec($queryPaz);
        echo "Tabella pazienti creata <br>";
    }catch(PDOException $e) {
        echo $query . "<br>" . $e->getMessage();
    }
    $querySpe = "CREATE TABLE IF NOT EXISTS $tabellaSpecializzazioni ( 
        codice_specia varchar(5) NOT NULL PRIMARY KEY, 
        descrizione varchar(30) NOT NULL
    )";

    try{

        $database1->exec($querySpe);
        echo "Tabella specializzazioni creata <br>";
    }catch(PDOException $e) {
        echo $query . "<br>" . $e->getMessage();
    }
/*$specializzazioni = array();
$specializzazioni[] = array('MI001','Medicina interna');
$specializzazioni[] = array('MEU02','Medicina di emergenza-urgenza') ;
$specializzazioni[] = array('G0003','Geriatria');
$specializzazioni[] = array('OM004','Oncologia medica');
$specializzazioni[] = array('AIC05','Allergologia ed immunologia clinica');
$specializzazioni[] = array('DV006','Dermatologia e venereologia');
$specializzazioni[] = array('N0007','Neurologia');
 for($i=0; $i< count($specializzazioni);$i++){
    $spec = $specializzazioni[$i];
    $cod = $spec[0];
    $descr = $spec[1];
    $query1 = "INSERT INTO $tabellaSpecializzazioni
	(codice_specia, descrizione) VALUES ('$cod', '$descr')";
    $database1->exec($query1);
    echo "la specializzazione $descr è stata inserita";
}*/
    $queryMed = "CREATE TABLE IF NOT EXISTS $tabellaMedici ( 
        ID_medico INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        codice_fiscale varchar(16) NOT NULL,
        nome varchar(30)	 NOT NULL,
        cognome varchar(30)	 NOT NULL,
        telefono varchar(15) NOT NULL,
        genere varchar(20) NOT NULL,
        cod_specia varchar(5),
        FOREIGN KEY (cod_specia) REFERENCES Specializzazioni(codice_specia)
    )";

    try{
        $database1->exec($queryMed);
        echo "Tabella medici creata <br>";
    }catch(PDOException $e) {
        echo $query . "<br>" . $e->getMessage();
    }

    $queryGe = "CREATE TABLE IF NOT EXISTS $tabellaGeneri ( 
        descrizione varchar(30) NOT NULL PRIMARY KEY 
    )";

    try{

        $database1->exec($queryGe);
        echo "Tabella generi creata <br>";
    }catch(PDOException $e) {
        echo $query . "<br>" . $e->getMessage();
    }
   /* $generi = array('privato','di base','accreditato','SSN');
    for($i=0; $i<count($generi); $i++){
        $query="INSERT INTO $tabellaGeneri (descrizione) VALUES ('$generi[$i]')";
        $database1->exec($query);
        echo "il genere $generi[$i] è stato inserito";
    }*/

    $queryPreno = "CREATE TABLE IF NOT EXISTS $tabellaPrenotazioni ( 
        ID_prenotazione INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        descrizione varchar(30) NOT NULL,
        id_medico INT NOT NULL,
        cod_specia varchar(5),
        id_paziente INT NOT NULL,
        data_prenotazione DATE NOT NULL,
        data_visita DATE NOT NULL,
        ora_visita TIME NOT NULL,
        effettuata varchar(30),
        FOREIGN KEY (id_medico) REFERENCES Medici(ID_medico),
        FOREIGN KEY (cod_specia) REFERENCES Specializzazioni(codice_specia),
        FOREIGN KEY (id_paziente) REFERENCES Medici(ID_paziente)
    )";

    try{

        $database1->exec($queryPreno);
        echo "Tabella prenotazioni creata <br>";
    }catch(PDOException $e) {
        echo $query . "<br>" . $e->getMessage();
    }

    $queryTip = "CREATE TABLE IF NOT EXISTS $tabellaTipiCC ( 
        descrizione varchar(30) NOT NULL PRIMARY KEY,
        osservazioni varchar(255) NOT NULL 
    )";

    try{

        $database1->exec($queryTip);
        echo "Tabella tipiCC creata <br>";
    }catch(PDOException $e) {
        echo $query . "<br>" . $e->getMessage();
    }
    /*$TipiCC = array('VISA','PostePay','Mastercard','PayPal');
    for($i=0; $i<count($TipiCC); $i++){
        $query="INSERT INTO $tabellaTipiCC (descrizione) VALUES ('$TipiCC[$i]')";
        $database1->exec($query);
        echo "il genere $TipiCC[$i] è stato inserito";
    }*/
    $queryPrest = "CREATE TABLE IF NOT EXISTS $tabellaPrestazioni ( 
        ID_prestazione INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        descrizione varchar(30) NOT NULL ,
        specialista varchar(25) NOT NULL,
        durata INT NOT NULL,
        costo INT NOT NULL
    )";

    try{

        $database1->exec($queryPrest);
        echo "Tabella prestazioni creata <br>";
    }catch(PDOException $e) {
        echo $query . "<br>" . $e->getMessage();
    }
    /*$prestazioni = array();
    $prestazioni[] = array('Analisi cliniche','root admin','1','50');
    $prestazioni[] = array('Check up','Samuel Oum','2','35') ;
    $prestazioni[] = array('Cone Beam-Radiologia odontoiatric digitale','Marco Antonio','1','45');
    $prestazioni[] = array('Diagnotica strumentale','Atangana Salomon','2','80');
    $prestazioni[] = array('Fisioterapia e medicina dello sport','root admin','1','50');
    $prestazioni[] = array('Medicina del lavoro','Salvatore Daniele','2','40');
    $prestazioni[] = array('Medicina estetica','root admin','1','50');
    $prestazioni[] = array('Poliambulatorio specialistico','root admin','1','50');
    $prestazioni[] = array('Radiologia, Tac e Risonanza magnetica','Samuel Oum','2','35') ;
    $prestazioni[] = array('Diagnostica Ecografica','Marco Antonio','1','45');
    $prestazioni[] = array('Diagnostica prenatale Ecografica','Atangana Salomon','2','80');
    $prestazioni[] = array('DiagnosticA strumentale Neurologica','root admin','1','50');
    $prestazioni[] = array('Ecografia addome inferiore','Salvatore Daniele','2','40');
    $prestazioni[] = array('Ecografia addome superiore','root admin','1','50');

    for($i=0; $i< count($prestazioni);$i++){
        $spec = $prestazioni[$i];
        $descr = $spec[0];
        $specialista = $spec[1];
        $durata = $spec[2];
        $costo = $spec[3];
        $query1 = "INSERT INTO $tabellaPrestazioni
        (descrizione,specialista,durata,costo) VALUES ('$descr','$specialista','$durata','$costo')";
        $database1->exec($query1);
        echo "la prestazione $descr è stata inserita";
    }*/
    $queryVis = "CREATE TABLE IF NOT EXISTS $tabellaVisite ( 
        ID_visita INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        descrizione varchar(30) NOT NULL ,
        id_prenotazione INT NOT NULL,
        data_visita  DATE NOT NULL,
        referto TEXT NOT NULL,
        FOREIGN KEY (id_prenotazione) REFERENCES Prenotazioni(ID_prenotazione)
    )";

     try{

        $database1->exec($queryVis);
        echo "Tabella visite creata <br>";
    }catch(PDOException $e) {
        echo $query . "<br>" . $e->getMessage();
    }

    $queryMedSp = "CREATE TABLE IF NOT EXISTS $tabellaMediciSpecializzazioni ( 
        id_medico INT NOT NULL,
        cod_specia varchar(5) NOT NULL ,
        osservazioni varchar(50),
        FOREIGN KEY (id_medico) REFERENCES Medici(ID_Medico),
        FOREIGN KEY (cod_specia) REFERENCES Medici(codice_specia),
        PRIMARY KEY (id_medico,cod_specia)
    )";

    try{

        $database1->exec($queryMedSp);
        echo "Tabella Medici specializzazioni creata <br>";
    }catch(PDOException $e) {
        echo $query . "<br>" . $e->getMessage();
    }
    

    /*$query1 = "INSERT INTO $tabellaUtenti
	(utente_id, nome,cognome,email, password, numero_di_telefono,città,residenza,sesso,numero_civico,cap,ruolo)
	VALUES
	('1', 'salomon','atangana','salomon7atangana@gmail.com','7Tonnerres', '1234567890','yaoundé','via flaminio','maschio', '21','01234','moderatore')
	";
    $database1->exec($query1);
    $query1 = "INSERT INTO $tabellaUtenti
	(utente_id, nome,cognome,email, password, numero_di_telefono,città,residenza,sesso,numero_civico,cap,ruolo)
	VALUES
	('2', 'Fouda','Ossono','fouda96@ossono.com','fouda_96', '2564567890','yaoundé','via vittorio Emanuele','maschio', '21','01234','utente')
	";
    $database1->exec($query1);
    $query1 = "INSERT INTO $tabellaUtenti
	(utente_id, nome,cognome,email, password, numero_di_telefono,città,residenza,sesso,numero_civico,cap,ruolo)
	VALUES
	('3', 'oum','ossono','oum20@ossono.com','OumOss_2000', '21356788','yaoundé','Ahala Barrière','femmina', '32','237','utente')
	";
    $database1->exec($query1);
    $query1 = "INSERT INTO $tabellaUtenti
	(utente_id, nome,cognome,email, password, numero_di_telefono,città,residenza,sesso,numero_civico,cap,ruolo)
	VALUES
	('4', 'root','phpmyadmin','root30@phpmyadmin.com','phpmyadmin', '3711743636','yaoundé','Ahala Barrière','maschio', '25B','00132','amministratore')
	";
    $database1->exec($query1);
    $query1 = "INSERT INTO $tabellaUtenti
	(utente_id, nome,cognome,email, password, numero_di_telefono,città,residenza,sesso,numero_civico,cap,ruolo)
	VALUES
	('5', 'Antonio','Mbarga','Mbarga_antonio@Atango.cmr','Mbarga_Antonio', '3711743237','yaoundé','Ahala Barrière','maschio', '75','01234','utente')
	";
    $database1->exec($query1);
    $query1 = "INSERT INTO $tabellaUtenti (utente_id, nome, cognome, email, password, numero_di_telefono, città, residenza, sesso, numero_civico, cap, ruolo) 
    VALUES 
    ('6', 'Marco', 'Rossi', 'MarcoRossi@Lweb.com', 'MaercoRossi', '3217547698', 'Roma', 'piazza del popolo', 'maschio', '23', '18234', 'moderatore')
    ";
    $database1->exec($query1);
    echo 'tabella popolata';*/
?>
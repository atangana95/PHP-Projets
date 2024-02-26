<?php 
    class Medico{
        private $codice_fiscale, $nome, $cognome, $telefono, $genere,$cod_specia;
        public function __construct($cod_fisc, $name, $surname, $tel, $genere, $cod_specializzazione){

            $this->codice_fiscale=$cod_fisc;
            $this->nome= $name;
            $this->cognome=$surname;
            $this->telefono= $tel;
            $this->genere= $genere;
            $this->cod_specia= $cod_specializzazione;
        }

        public function getCodice_fiscale(){
            return $this->codice_fiscale;
       }

       public function getNome(){
           return $this->nome;
       }

       public function getCognome(){
           return $this->cognome;
       }

       public function getTelefono(){
        return $this->telefono;
        }

        public function getGenere(){
            return $this->genere;
        }

        public function getCod_Specializzazione(){
            return $this->cod_specia;
        }

        public function setCodice_fiscale($codice_fisc){
            $this->codice_fiscale= $codice_fisc;
            $tabellaMedici = "Medici";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $nuovoNome =$database->prepare("UPDATE $tabellaMedici SET codice_fiscale=? WHERE nome=? AND cognome=?");
            $nuovoNome->execute(array($codice_fisc,$this->getNome(),$this->getCognome()));
            return 'codice fiscale inserito';
        }

        public function setCognome($surname){
            $this->cognome=$surname;
            $tabellaMedici = "Medici";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $nuovoNome =$database->prepare("UPDATE $tabellaMedici SET cognome=? WHERE codice_fiscale=? ");
            $nuovoNome->execute(array($surname,$this->getCodice_fiscale()));
            return 'il cognome è stato inserito';
        }
 
        public function setNome($name){
            $this->nome=$name;
            $tabellaMedici = "Medici";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $nuovoNome =$database->prepare("UPDATE $tabellaMedici SET nome=? WHERE codice_fiscale=? ");
            $nuovoNome->execute(array($name,$this->getCodice_fiscale()));
            return 'il cognome è stato inserito';
        }

       public function setTelefono($telefono){
            $this->telefono= $telefono;
            $tabellaMedici = "Medici";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $nuovoNome =$database->prepare("UPDATE $tabellaMedici SET telefono=? WHERE codice_fiscale=? ");
            $nuovoNome->execute(array($telefono,$this->getCodice_fiscale()));
            return 'il telefono è stato modificato';
        }

        public function setGenere($genere){
            $this->gen=$genere;
            $tabellaMedici = "Medici";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $nuovoNome =$database->prepare("UPDATE $tabellaMedici SET genere=? WHERE codice_fiscale=? ");
            $nuovoNome->execute(array($name,$this->getCodice_fiscale()));
            return 'il genere è stato modificato';

        }

        public function setCod_Specializzazione($specializzazione){
            $this->cod_specia=$specializzazione;
            $tabellaMedici = "Medici";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $nuovoNome =$database->prepare("UPDATE $tabellaMedici SET cod_specia=? WHERE codice_fiscale=? ");
            $nuovoNome->execute(array($name,$this->getCodice_fiscale()));
            return 'il codice specializzazione è stato modificato';

        }

        public function Registrazione($tabellaMedici):string{
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $user = "root";
            $passw = "";
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $Utente = $database->prepare("INSERT INTO $tabellaMedici(codice_fiscale,nome,cognome,telefono,genere,cod_specia)VALUES (?,?,?,?,?,?)");
            if ($Utente->execute(array($this->codice_fiscale,$this->nome,$this->cognome,$this->telefono,$this->genere,$this->cod_specia)))
                return 'Dottore '.$this->nome.' '.$this->cognome.' la sua registrazione è terminata con successo! Adesso puo andare a fare il login cliccando sul link giallo in basso' ;
            else {
                return "<div class=\"alert alert-success\" role=\"alert\">La sua registrazione non è andata a buon fine!</div>";
            }
        }           

        public function AccessBD(){
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $user = "root";
            $passw = "";
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            return $database;
        }          

    }
?>
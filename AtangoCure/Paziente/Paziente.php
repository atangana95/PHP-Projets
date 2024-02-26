<?php 
    class Paziente{
        private $codice_fiscale,$cognome, $nome, $email, $password, $indirizzo, $numero_civico, $cap, $telefono, $fax;

        public function __construct($codice_fiscale, $cognome, $nome, $email, $password, $indirizzo,
         $numero_civico, $cap, $telefono, $fax){

            $this->codice_fiscale = $codice_fiscale;
            $this->cognome = $cognome;
            $this->nome= $nome;
            $this->email= $email;
            $this->password= $password;
            $this->indirizzo= $indirizzo;
            $this->numero_civico = $numero_civico;
            $this->cap = $cap;
            $this->telefono= $telefono;
            $this->fax = $fax;

        }
        public function setCodice_fiscale($codice_fisc){
            $this->codice_fiscale= $codice_fisc;
            $tabellaPazienti = "Pazienti";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET codice_fiscale=? WHERE nome=? AND cognome=?");
            $nuovoNome->execute(array($codice_fisc,$this->getNome(),$this->getCognome()));
            return 'codice fiscale inserito';

        }

        public function setCognome($surname){
            $this->cognome=$surname;
            $tabellaPazienti = "Pazienti";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET cognome=? WHERE codice_fiscale=? ");
            $nuovoNome->execute(array($surname,$this->getCodice_fiscale()));
            return 'il cognome è stato inserito';
        }
 
        public function setNome($name){
            $this->nome=$name;
            $tabellaPazienti = "Pazienti";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET nome=? WHERE codice_fiscale=? ");
            $nuovoNome->execute(array($name,$this->getCodice_fiscale()));
            return 'il cognome è stato inserito';

       }

       public function setEmail($mail){
           $this->email=$mail;
           $tabellaPazienti = "Pazienti";
           $user = "root";
           $passw = "";
           $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
           $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
           $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET email=? WHERE codice_fiscale=? ");
           $nuovoNome->execute(array($email,$this->getCodice_fiscale()));
           return 'email inserita';

       }

       public function setPassword($pass){
           $this->password=$pass;
           $tabellaPazienti = "Pazienti";
           $user = "root";
           $passw = "";
           $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
           $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
           $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET password=? WHERE codice_fiscale=? ");
           $nuovoNome->execute(array($pass,$this->getCodice_fiscale()));
           return 'la password e è stata inserita';

       }

       public function setIndirizzo($indirizzo){
            $this->indirizzo = $indirizzo;
            $tabellaPazienti = "Pazienti";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET cognome=? WHERE codice_fiscale=? ");
            $nuovoNome->execute(array($surname,$this->getCodice_fiscale()));
            return 'il cognome è stato inserito';

       }

       public function setNumero_civico($numero_civico){
            $this->numero_civico= $numero_civico;
            $tabellaPazienti = "Pazienti";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET numero_civico=? WHERE codice_fiscale=? ");
            $nuovoNome->execute(array($numero_civico,$this->getCodice_fiscale()));
            return 'il numero civico è stato inserito';

       }

       public function setCap($cap){
            $this->cap = $cap;
            $tabellaPazienti = "Pazienti";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET cap=? WHERE codice_fiscale=? ");
            $nuovoNome->execute(array($cap,$this->getCodice_fiscale()));
            return 'il cap è stato inserito';

       }
       public function setTelefono($telefono){
            $this->telefono= $telefono;
            $tabellaPazienti = "Pazienti";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET telefono=? WHERE codice_fiscale=? ");
            $nuovoNome->execute(array($telefono,$this->getCodice_fiscale()));
            return 'il telefono è stato inserito';

       }

       public function setFax($fax){
            $this->fax= $fax;
            $tabellaPazienti = "Pazienti";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET fax=? WHERE codice_fiscale=? ");
            $nuovoNome->execute(array($fax,$this->getCodice_fiscale()));
            return 'il fax è stato inserito';
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
       public function getEmail(){
           return $this->email;
       }

       public function getPassword(){
           return $this->password;
       }

       public function getIndirizzo(){
            return $this->indirizzo;
       }

       public function getNumero_civico(){
            return $this->numero_civico;
       }

       public function getCap(){
            return $this->cap;
        }

        public function getTelefono(){
            return $this->telefono;
       }

       public function getFax(){
            return $this->fax;
       }

       public function Registrazione($tabellaPazienti):string{
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $user = "root";
            $passw = "";
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $Utente = $database->prepare("INSERT INTO $tabellaPazienti(codice_fiscale,cognome,nome,email,password,indirizzo,numero_civico,cap,telefono,fax)VALUES (?,?,?,?,?,?,?,?,?,?)");
            if ($Utente->execute(array($this->codice_fiscale,$this->cognome,$this->nome,$this->email,$this->password,$this->indirizzo,$this->numero_civico,$this->cap,$this->telefono,$this->fax)))
                return 'caro '.$this->nome.' '.$this->cognome.' la sua registrazione è terminata con successo! Adesso puo andare a fare il login cliccando sul link giallo in basso' ;
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
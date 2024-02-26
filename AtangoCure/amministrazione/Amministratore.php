<?php
    class Amministratore{
        private $nome, $cognome, $mail, $passw, $dati=[];

        public function __construct($name, $surname, $email, $password){
            $this->nome= $name;
            $this->cognome = $surname;
            $this->mail = $email;
            $this->passw = $password;
        }
        $tabellaAmministratori = "Amministratori";
        public function setCognome($surname){
            $this->cognome=$surname;
            $tabellaAmministratori = "Amministratori";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $nuovoNome =$database->prepare("UPDATE $tabellaAmministratori SET cognome=? WHERE email=? AND password=?");
            $nuovoNome->execute(array($surname,$this->getEmail(),$this->getPassword()));
            return 'il cognome è stato inserito';
        }
 
        public function setNome($name){
            $this->nome=$name;
            $tabellaAmministratori = "Amministratori";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $nuovoNome =$database->prepare("UPDATE $tabellaAmministratori SET nome=? WHERE email=? AND password=? ");
            $nuovoNome->execute(array($name,$this->getEmail(),$this->getPassword()));
            return 'il cognome è stato inserito';
       }

       public function setEmail($mail){
           $this->email=$mail;
           $tabellaAmministratori = "Amministratori";
           $user = "root";
           $passw = "";
           $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
           $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
           $nuovoNome =$database->prepare("UPDATE $tabellaAmministratori SET email=? WHERE nome=? AND cognome=?");
           $nuovoNome->execute(array($email,$this->getNome(), $this->getCognome()));
           return 'email inserita';
       }

       public function setPassword($pass){
           $this->password=$pass;
           $tabellaAmministratori = "Amministratori";
           $user = "root";
           $passw = "";
           $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
           $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
           $nuovoNome =$database->prepare("UPDATE $tabellaAmministratori SET password=? WHERE WHERE nome=? AND cognome=? AND Email=? ");
           $nuovoNome->execute(array($pass,$this->getNome(), $this->getCognome(), $this->getEmail()));
           return 'la password e è stata inserita';
       }

       public function getNome(){
            return $this->nome;
        }

        public function getCognome(){
            return $this->cognome;
        }
        public function getEmail(){
            return $this->mail;
        }

        public function getPassword(){
            return $this->passw;
        }

        public function AddAmministratore($name, $surname, $email, $password=""){
            $tabellaAmministratori = "Amministratori";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $Utente = $database->prepare("INSERT INTO $tabellaAmministratori(nome,cognome,email,password)VALUES (?,?,?,?)");
            if ($Utente->execute(array($name, $surname, $email, $password)))
                return $name.' '.$surname.' è stato inserito come amministratore' ;
            else {
                return "<div class=\"alert alert-success\" role=\"alert\">oops! l'inserimento del nuovo amministratore non è andato a buon fine, riprovi</div>";
            }

        }

        public function setPasswordPaziente($codice_fiscale, $pass){
            $tabellaPazienti = "Pazienti";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $sql = "SELECT cognome, nome, password FROM $tabellaPazienti WHERE  codice_fiscale = ?";
            $DatiUtente =$database->prepare($sql);
            $DatiUtente->execute(array($codice_fiscale));
            if($DatiUtente->rowCount()>0){
                while($risultati = $DatiUtente->fetch()){
                    $cognome= $risultati['cognome'];
                    $nome = $risultati['nome'];
                    $password = $risultati['password'];
                    $this->dati = array($cognome,$nome,$password);
                }
            }
            $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET password=? WHERE codice_fiscale=? ");
            $nuovoNome->execute(array($pass,$codice_fiscale));
            return 'la password è stata modificata';
        }

        public function DeletePaziente($codice_fiscale){
            $tabellaPazienti = "Pazienti";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $sql = "SELECT cognome, nome FROM $tabellaPazienti WHERE  codice_fiscale = ?";
            $DatiUtente =$database->prepare($sql);
            $DatiUtente->execute(array($codice_fiscale));
            if($DatiUtente->rowCount()>0){
                while($risultati = $DatiUtente->fetch()){
                    $cognome= $risultati['cognome'];
                    $nome = $risultati['nome'];
                }
            }
            $sql = "DELETE FROM $tabellaPazienti WHERE  codice_fiscale = ?";
            $DatiUtente =$database->prepare($sql);
            $DatiUtente->execute(array($codice_fiscale));
            return 'utente '.$nome.' '.$cognome.' cancellato dal sistema';
        }

        public function DeleteMedico($codice_fiscale){
            $tabellaMedici = "Medici";
            $user = "root";
            $passw = "";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $sql = "SELECT nome, cognome FROM $tabellaMedici WHERE  codice_fiscale = ?";
            $DatiUtente =$database->prepare($sql);
            $DatiUtente->execute(array($codice_fiscale));
            if($DatiUtente->rowCount()>0){
                while($risultati = $DatiUtente->fetch()){
                    $cognome= $risultati['cognome'];
                    $nome = $risultati['nome'];
                }
            }
            $sql = "DELETE FROM $tabellaMedici WHERE  codice_fiscale = ?";
            $DatiUtente =$database->prepare($sql);
            $DatiUtente->execute(array($codice_fiscale));
            return "medico $nome $cognome cancellato dal sistema";
        }

        public function AddSpecializzazione($codice_specia, $descrizione){
            $tabellaSpecializzazioni = "Specializzazioni";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $user = "root";
            $passw = "";
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $Utente = $database->prepare("INSERT INTO $tabellaSpecializzazioni(codice_specia, descrizione)VALUES (?,?)");
            if ($Utente->execute(array($codice_specia,$descrizione)))
                return "specializzazione $descrizione aggiunta " ;
            else {
                return "<div class=\"alert alert-success\" role=\"alert\">l'inserimento della nuova specializzazione non è andato a buon fine!</div>";
            }
        }

        public function DeleteSpecializzazione($codice_specia,$descrizione){
            $tabellaSpecializzazioni = "Specializzazioni";
            $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
            $user = "root";
            $passw = "";
            $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $sql = "DELETE FROM $tabellaSpecializzazioni WHERE  codice_specia = ?";
            $DatiUtente =$database->prepare($sql);
            $DatiUtente->execute(array($codice_specia));
            return "la specializzazione $codice_specia è stata cancellata dal sistema";
        }
    }
?>
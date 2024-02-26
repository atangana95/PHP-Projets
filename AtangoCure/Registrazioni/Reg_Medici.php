<?php 
    //ini_set('display_errors', false);
    //error_reporting(E_ALL);

    $titre="Registrazione";
?>
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title><?= $titre ?></title>
        <link href="../mystyle.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">    
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>    
    </head>

        <?php 
            include("../config.php");
            include("../Medico/Medici.php");
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
              }
            $ErrorNome = '';
            $ErrorCognome = '';
            $ErrorTel = '';
            $ErrorGen = '';
            $ErrorCodice_fisc = '';
            $ErrorSpeica = '';
            $count = 0;
            if(isset($_POST['invio'])){
                if(!empty($_POST['codice_fiscale'])){
                    $codice_fisc = htmlspecialchars($_POST['codice_fiscale']);
                }else{
                    $ErrorCodice_fisc = 'il codice fiscale deve essere inserito!';
                    $count +=1;
                }
                if(!empty($_POST['cognome'])){
                    $cognome=htmlspecialchars($_POST['cognome']);
                }else{
                    $ErrorCognome = 'inserisci il campo cognome';
                    $count +=1;
                }

                if(!empty($_POST['nome'])){
                    $nome=htmlspecialchars($_POST['nome']);
                }else{
                    $ErrorNome = 'deve inserire il campo nome';
                    $count +=1;
                }
                if(!empty($_POST['telefono'])){
                    $telefono="";
                    if(preg_match("/^([0-9]{10})$/",$_POST['telefono'])){
                        $telef = htmlspecialchars($_POST['telefono']);
                        $sql = "SELECT telefono FROM $tabellaPazienti ";
                        $Users = $database->query($sql);
                        if($Users->rowCount()>0){
                            while($User = $Users->fetch()){
                                $Tel[] = $User['telefono'];
                            }
                            if(in_array($telef,$Tel)){
                                $ErrorTel = "esiste un altro paziente gia registrato con questo numero di telefono<br>";
                                echo "<div class=\"alert alert-danger\" role=\"alert\">
                                    $Errormessage </div>";
                            }else{
                                $telefono = htmlspecialchars($_POST['telefono']);
                            }
                        } 
                    }
                    else{               
                        $ErrorTel = 'numero di telefono non valido!';
                        $count +=1;
                    }  
                }else{
                    $ErrorTel = 'devi inserire in numero di telefono!';
                    $count +=1;
                }
                if(!empty($_POST['genere'])){
                    $genere=htmlspecialchars($_POST['genere']);
                }else{
                    $ErrorGen = 'deve inserire il genere';
                    $count +=1;
                }
                if(!empty($_POST['specia'])){
                    $cod_specia=htmlspecialchars($_POST['specia']);
                }else{
                    $ErrorSpeica = 'deve inserire la specializzazione';
                    $count +=1;
                }

                if($count > 0){
                    $Errormessage= "ci sono $count Errori!<br><br>";
                    //$Errormessage = $ErrorNome.$ErrorCognome.$ErrorEmail.$ErrorPassword.$ErrorTel;
                    echo "<div class=\"alert alert-danger\" role=\"alert\">
                    $Errormessage </div>";
                }else{
                    $medico = new Medico($codice_fisc,$nome,$cognome,$telefono,$genere,$cod_specia);
                    $ritorno=$medico->Registrazione($tabellaMedici);
                    if($cod_specia!='MB000'){
                        $sql = "SELECT ID_medico FROM $tabellaMedici WHERE  codice_fiscale = ?";
                        $DatiUtente =$database->prepare($sql);
                        $DatiUtente->execute(array($codice_fisc));
                        if($DatiUtente->rowCount()>0){
                            $risultati = $DatiUtente->fetch();
                            $ID_medico=$risultati['ID_medico'];
                        }
                        $sql1 = "INSERT INTO $tabellaMediciSpecializzazioni (id_medico,cod_specia,osservazioni) VALUES ('$ID_medico','$cod_specia','tutti i giorni da lunedi a venerdi dalle ore 9 alle ore 17')";
                        $database->exec($sql1);
                    }
                    echo $ritorno;
                }
            }
        ?>
    <body class="center">
        <br><br><br>
        <div class="container">
            <h1>Studio medico AtangoCure</h1>
            <h3>Registrazione Medici</h3>                
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="mb-3">
                    <label >codice fiscale</label>
                    <input type="text"  name="codice_fiscale" value="<?php if(isset($_POST['codice_fiscale']))echo $_POST['codice_fiscale']; ?>"/>
                    <span class="text-danger">* <?= $ErrorCodice_fisc;?></span>
                </div>
                <div class="mb-3">
                    <label>nome : </label>
                    <input type="text" name="nome" value="<?php if(isset($_POST['nome']))echo $_POST['nome']; ?>" />
                    <span class="text-danger">* <?= $ErrorNome;?></span>
                </div>
                <div class="mb-3">
                    <label>cognome : </label>
                    <input type="text" name="cognome" value="<?php if(isset($_POST['cognome']))echo $_POST['cognome']; ?>"/>
                    <span class="text-danger">* <?= $ErrorCognome;?></span>
                </div>
                <div class="mb-3">
                    <label >telefono</label>
                    <input type="text" name="telefono" value="<?php if(isset($_POST['telefono']))echo $_POST['telefono']; ?>" />
                    <span class="text-danger">* <?= $ErrorTel;?></span>
                </div>
                <div class="mb-3">
                    <label >genere</label>
                    <select  name="genere">
                    <?php 
                        $specia = $database->query("SELECT * FROM $tabellaGeneri");
                        if($specia->rowCount()>0){
                            while($Dati = $specia->fetch()){
                                $descrizione = $Dati['descrizione']; ?>
                                <option value="<?=$descrizione ?>"><?=$descrizione ?></option>

             <?php         }
                        }
                    ?> 
                    </select>
                    <span class="text-danger">* <?= $ErrorGen;?></span>
                </div>
                <div class="mb-3">
                    <label for="">specializzazione: </label>
                    <select  name="specia">
                    <?php 
                        $specia = $database->query("SELECT * FROM $tabellaSpecializzazioni");
                        if($specia->rowCount()>0){
                            while($Dati = $specia->fetch()){
                                $codice = $Dati['codice_specia'];
                                $descrizione = $Dati['descrizione']; ?>
                                <option value="<?=$codice ?>"><?=$descrizione ?></option>

             <?php         }
                        }
                    ?> 
                    </select>
                    <span class="text-danger">* <?= $ErrorSpeica;?></span>
                </div>
                <button type="submit" class="btn btn-primary" name="invio">Registrati</button>
                <br><br>
                <a href="../Medico/Login_Medici.php" class="btn btn-warning" ><p>hai un account? fai il Login</p></a> 
            </form>
        </div>
<?php
    include("Footer.php");
?>
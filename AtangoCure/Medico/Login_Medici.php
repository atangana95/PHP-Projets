<?php 
   $titre="Login";
    require "../config.php";
?>
<?php
    if(isset($_POST['send'])){
        if (empty($_POST['codice_fiscale'])) {
            echo 'Inserisci il codice fiscale';
        }else {
            $codice_fiscale = htmlspecialchars($_POST['codice_fiscale']);
            $sql = "SELECT * FROM $tabellaMedici WHERE  codice_fiscale = ?";
            $DatiUtente =$database->prepare($sql);
            $DatiUtente->execute(array($codice_fiscale));
            if($DatiUtente->rowCount()>0){
                $risultati = $DatiUtente->fetch();
                echo 'sei effettivamente registrato';
                    session_start();
                    $_SESSION['utente_id']=$risultati['ID_medico'];
                    $_SESSION['nome']=$risultati['nome'];
                    $_SESSION['cognome']=$risultati['cognome'];
                    $_SESSION['dataLogin']=time();
                    $_SESSION['accesso']=true;

                    header('Location: index_Medico.php');
            }
            else{
                echo "<p>accesso negato!!!</p>";
            }

        }
    }
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

    <body class="center">
        <br><br>
        <form  method="post" class="container">
            <h3>sei gia registrato? Allora esegui il login</h3>
            <div class="mb-3">
                <label>codice_fiscale : </label>
                <input type="text" name="codice_fiscale" /><br><br>
            </div>
            <button type="submit" class="btn btn-primary"  name="send">Login</button>
            <br><br>
            <a href="../Registrazioni/Reg_Medici.php" class="btn btn-warning" ><p>non hai un account? Registrati</p></a>
        </form>
<?php
    include("../Footer.php");
?>

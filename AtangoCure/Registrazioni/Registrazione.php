<?php 
    ini_set('display_errors', true);
    error_reporting(E_ALL);

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
            include("../Paziente.php");
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
              }
            $ErrorNome = '';
            $ErrorCognome = '';
            $ErrorEmail = '';
            $ErrorPassword = '';
            $ErrorTel = '';
            $Errorfax = '';
            $ErrorCodice_fisc = '';
            $ErrorResid = '';
            $ErrorCiv = '';
            $ErrorCap = '';
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
                    $ErrorNome = 'devi inserire il campo nome';
                    $count +=1;
                }
                if(!empty($_POST['email'])){
                    $email = test_input($_POST["email"]);
                    // check if e-mail address is well-formed
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $ErrorEmail = "email non valido";
                        $count +=1;
                    }else{
                        $sql = "SELECT email FROM $tabellaPazienti ";
                        $Users = $database->query($sql);
                        if($Users->rowCount()>0){
                            while($User = $Users->fetch()){
                                $Email[] = $User['email'];
                            }
                            if(in_array($email,$Email)):
                                $ErrorEmail = 'esiste un altro paziente gia registrato con questa mail';
                            else :
                                $email=htmlspecialchars( $_POST['email']);
                            endif;
                        }        
                    }
                }else{
                    $ErrorEmail = 'inserisci il campo email';
                    $count +=1;
                }
                if(empty($_POST['password'])){
                    $ErrorPassword = 'inserisci la password';
                    $count +=1;
                }else{
                    $password=htmlspecialchars( $_POST['password']);
                }
                if(!empty($_POST['indirizzo'])){
                    $indirizzo = htmlspecialchars($_POST['indirizzo']);
                }else{
                    $ErrorResid = "l\'indirizzo deve essere inserito'!";
                    $count +=1;
                }
                if(!empty($_POST['civico'])){
                    $civ = htmlspecialchars($_POST['civico']);
                    if(preg_match("/^([0-9]{1,3})[a-zA-Z]?/",$_POST['civico'])){
                        $civico = htmlspecialchars($_POST['civico']);
                    }else{
                        $ErrorCiv = 'il numero civico inserito non è valido!';
                        $count +=1;
                    }
                }else{
                    $ErrorCiv = 'il numero civico deve essere inserito!';
                }
                if(!empty($_POST['cap'])){
                    if(preg_match("/^([0-9]{5})$/",$_POST['cap'])){
                        $cap = htmlspecialchars($_POST['cap']);
                    }else{
                        $ErrorCap = ' cap non valido! il cap deve essere composto di 5 numeri';
                        $count +=1;
                    }
                }else{
                    $ErrorCap = 'il cap deve essere inserito!';
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
                }
                if(!empty($_POST['fax'])){
                    $fax="";
                    if(preg_match("/^([0-9]{10})$/",$_POST['fax'])){
                        $telef = htmlspecialchars($_POST['fax']);
                        $sql = "SELECT fax FROM $tabellaPazienti ";
                        $Users = $database->query($sql);
                        if($Users->rowCount()>0){
                            while($User = $Users->fetch()){
                                $Tel[] = $User['fax'];
                            }
                            if(in_array($telef,$Tel)){
                                $ErrorTel = "esiste un altro paziente gia registrato con questo fax <br>";
                                echo "<div class=\"alert alert-danger\" role=\"alert\">
                                    $Errormessage </div>";
                            }else{
                                $fax = htmlspecialchars($_POST['fax']);
                            }
                        } 
                    }
                    else{               
                        $Errorfax = 'fax non valido!';
                        $count +=1;
                    }  
                }
                if($count > 0){
                    $Errormessage= "ci sono $count Errori!<br><br>";
                    //$Errormessage = $ErrorNome.$ErrorCognome.$ErrorEmail.$ErrorPassword.$ErrorTel;
                    echo "<div class=\"alert alert-danger\" role=\"alert\">
                    $Errormessage </div>";
                }else{
                    $paziente = new Paziente($codice_fisc,$cognome,$nome,$email,$password,$indirizzo,$civico,$cap,$telefono,$fax);
                    $ritorno=$paziente->Registrazione($tabellaPazienti);
                    echo $ritorno;
                }
            }
        ?>
    <body class="center">
        <br><br><br>
        <div class="container">
            <h1>Studio medico AtangoCure</h1>
            <h3>Registrazione pazienti</h3>                
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
                    <label>email : </label>
                    <input type="text" name="email" value="<?php if(isset($_POST['email']))echo $_POST['email']; ?>"/>
                    <span class="text-danger">* <?= $ErrorEmail;?></span>
                </div>
                <div class="mb-3">
                    <label>password : </label>
                    <input type="password" name="password" id="myInput" <?php if(isset($_POST['password']))echo $_POST['password']; ?> />
                    <span class="text-danger">* <?= $ErrorPassword;?></span>
                </div>
                <div class="mb-3">
                    <label >indirizzo</label>
                    <input type="text"  name="indirizzo" value="<?php if(isset($_POST['indirizzo']))echo $_POST['indirizzo']; ?>" />
                    <span class="text-danger">* <?= $ErrorResid;?></span>
                </div>
                <div class="mb-3">
                    <label >numero civico</label>
                    <input type="text"  name="civico" value="<?php if(isset($_POST['civico']))echo $_POST['civico']; ?>"/>
                    <span class="text-danger">* <?= $ErrorCiv;?></span>
                </div>
                <div class="mb-3">
                    <label >CAP</label>
                    <input type="text"  name="cap" value="<?php if(isset($_POST['cap']))echo $_POST['cap']; ?>"/>
                    <span class="text-danger">* <?= $ErrorCap;?></span>
                </div>
                <div class="mb-3">
                    <label >telefono</label>
                    <input type="text" name="telefono" value="<?php if(isset($_POST['telefono']))echo $_POST['telefono']; ?>" />
                    <span class="text-danger">* <?= $ErrorTel;?></span>
                </div>
                <div class="mb-3">
                    <label >fax</label>
                    <input type="text" name="fax" value="<?php if(isset($_POST['fax']))echo $_POST['fax']; ?>" />
                    <span class="text-danger">* <?= $Errorfax;?></span>
                </div>

                <button type="submit" class="btn btn-primary" name="invio">Registrati</button>
                <br><br>
                <a href="../Login_Pazienti.php" class="btn btn-warning" ><p>hai un account? fai il Login</p></a> 
            </form>
        </div>
<?php
    include("Footer.php");
?>
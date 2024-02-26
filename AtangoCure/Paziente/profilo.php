<?php
    $titre='Profilo';
    include("../Headers/Header_pazienti.php");
    include("../config.php");
  ?>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index_paziente.php"><img src="../logo/AtangoCure 1.jpg" class="rounded-circle" alt="Logo" width="90" height="70"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
                <li class="nav-item active">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </ul>

    </nav>  
<div class="container">
    <div class="row">
        <?php
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            $sql = "SELECT * FROM $tabellaPazienti WHERE  cognome = ? AND nome = ? ";
            $Users = $database->prepare($sql);
            $Users->execute(array($_SESSION['cognome'],$_SESSION['nome']));
            if($Users->rowCount()>0){
                while($User = $Users->fetch()){
                    $id = $User['ID_paziente'];
                    $codice_fisc = $User['codice_fiscale'];
                    $nome = $User['nome'];
                    $cognome = $User['cognome'];
                    $email = $User['email'];
                    $passw = $User['password'];
                    $tel = $User['telefono'];
                    $indirizzo = $User['indirizzo'];
                    $cap = $User['cap'];
                    $civi = $User['numero_civico'];
                    $fax = $User['fax'];
                }        
            }        
        ?>
        <div class="col-md-4 card bg-dark text-light">
            <div class="card-body">
                <h4>I miei dati registrati</h4>
                <p>codice fiscale: <?= $codice_fisc ?></p>
                <p>Cognome: <?= $cognome ?></p>
                <p>Nome: <?= $nome ?></p>
                <p>Email: <?= $email ?></p>
                <p>indirizzo: <?=$indirizzo ?></p>
                <p>numero civico: <?= $civi?></p>
                <p>cap: <?= $cap?></p>
                <p>telefono: <?= $tel?></p>
                <p>fax: <?=$fax ?></p>
            </div>
        </div>
        <?php 
            $Errormessage = '';
            $ErrorEmail = '';
            $ErrorPassword='';
            $ErrorNuovaPassword='';
            $ErrorTel ='';
            $ErrorFax ='';
            $ErrorCiv = '';
            $Errorcap = '';
            $count = 0;
            if(isset($_POST['aggiorna'])){
                if(isset($_POST['passwordCorrente'])){
                    $actualPass = $_POST['passwordCorrente'];
                    if($passw!= $actualPass){
                        $ErrorPassword = 'la password corrente appena inserita non  corrisponde con la password di registrazione';
                    }else{
                        if(!empty($_POST['nome'])){
                            $name = htmlspecialchars($_POST['nome']);
                            $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET nome=? WHERE ID_paziente=?");
                            $nuovoNome->execute(array($name, $id));
                            $_SESSION['nome'] = $name;
                        }
                        if(!empty($_POST['cognome'])){
                            $surname = htmlspecialchars($_POST['cognome']);
                            $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET cognome=? WHERE ID_paziente=?");
                            $nuovoNome->execute(array($surname,$id));
                            $_SESSION['cognome'] = $surname;
                        }
                        if(!empty($_POST['email'])){
                            $email = test_input($_POST["email"]);
                            // check if e-mail address is well-formed
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $ErrorEmail = "email non valido";
                                $count +=1;
                            }else{
                                $Newmail = htmlspecialchars($_POST['email']);
                                $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET email=? WHERE ID_paziente=?");
                                $nuovoNome->execute(array($Newmail,$id));
                            }
                        }
                        if(!empty($_POST['passwordCorrente']) && !empty($_POST['NuovaPassword']) && !empty($_POST['ConfermaPassword'])){
                            $OldPassw = htmlspecialchars($_POST['passwordCorrente']);
                            if($OldPassw != $passw){
                                $ErrorPassword = 'La password corrente non è corretta!';
                                $count +=1;
                            }else{
                                if($_POST['NuovaPassword']== $_POST['ConfermaPassword']){
                                    $NewPassw = htmlspecialchars($_POST['NuovaPassword']);
                                    $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET password=? WHERE ID_paziente=?");
                                    $nuovoNome->execute(array($NewPassw,$id));        
                                }
                                else{
                                    $ErrorNuovaPassword = ' la password di conferma non corrisponde con la nuova password!';
                                    $count +=1;
                                }
                            }
                        }
                        if(!empty($_POST['telefono'])){
                            if(preg_match("/^([0-9]{10})$/",$_POST['telefono'])){
                                $telef = htmlspecialchars($_POST['telefono']);
                                $sql = "SELECT telefono FROM $tabellaPazienti ";
                                $Users = $database->query($sql);
                                if($Users->rowCount()>0){
                                    while($User = $Users->fetch()){
                                        $Tel[] = $User['telefono'];
                                    }
                                    if(in_array($telef,$Tel)):
                                        $ErrorTel = 'esiste un altro utente gia registrato con questo numero di telefono';
                                        $count += 1;
                                    else :
                                        $telefono = htmlspecialchars($_POST['telefono']);
                                        $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET telefono=? WHERE ID_paziente=?");
                                        $nuovoNome->execute(array($telefono,$id));
                                    endif;
                                }        

                            }else{
                                $ErrorTel = 'numero di telefono non valido!';
                                $count += 1;
                            }
                        }            
                        if(!empty($_POST['fax'])){
                            if(preg_match("/^([0-9]{10})$/",$_POST['fax'])){
                                $fax = htmlspecialchars($_POST['fax']);
                                $sql = "SELECT fax FROM $tabellaPazienti ";
                                $Users = $database->query($sql);
                                if($Users->rowCount()>0){
                                    while($User = $Users->fetch()){
                                        $Tel[] = $User['fax'];
                                    }
                                    if(in_array($telef,$Tel)):
                                        $ErrorTel = 'esiste un altro utente gia registrato con questo fax';
                                        $count += 1;
                                    else :
                                        $fax = htmlspecialchars($_POST['fax']);
                                        $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET fax=? WHERE ID_paziente=?");
                                        $nuovoNome->execute(array($fax,$id));
                                    endif;
                                }        

                            }else{
                                $ErrorTel = 'fax non valido!';
                                $count += 1;
                            }
                        }               
                        if(!empty($_POST['indirizzo'])){
                            $indirizzo = htmlspecialchars($_POST['indirizzo']);
                            $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET città=? WHERE ID_paziente=?");
                            $nuovoNome->execute(array($indirizzo,$id));
                        }
                        if(!empty($_POST['residenza'])){
                            $residenza = htmlspecialchars($_POST['residenza']);
                            $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET residenza=? WHERE ID_paziente=?");
                            $nuovoNome->execute(array($residenza,$id));
                        }
                        if(!empty($_POST['numero_civico'])){
                            if(preg_match("/^(([0-9]{1,3})[a-zA-Z]?)$/",$_POST['numero_civico'])){
                                $numero_civico = htmlspecialchars($_POST['numero_civico']);
                                $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET numero_civico=? WHERE ID_paziente=?");
                                $nuovoNome->execute(array($numero_civico,$id));    
                            }else{
                                $ErrorCiv = 'il numero numero_civico inserito non è valido!';
                            }
                        }
                        if(!empty($_POST['cap'])){
                            if(preg_match("/^([0-9]{5})$/",$_POST['cap'])){
                                $cap = htmlspecialchars($_POST['cap']);
                                $nuovoNome =$database->prepare("UPDATE $tabellaPazienti SET cap=? WHERE ID_paziente=?");
                                $nuovoNome->execute(array($cap,$id));
                            }else{
                                $Errorcap = ' cap non valido! il cap deve essere composto di 5 numeri';
                            }
                        }        
                    }
                }else{
                    $ErrorPassword = 'questo campo deve essere obbligatoriamente compilato';
                }
            }
        ?>
        <div class="col-md-6">
        <form method="post" >
            <h2>Modifica i dati di registrazione</h2>
            <div class="mb-3">
                <label >Nome</label>
                <input type="text" class="form-control" name="nome"  value="<?php if(isset($_POST['nome'])){echo $_POST['nome'];
                $_SESSION['nome']=$_POST['nome'];}?>">
            </div>
            <div class="mb-3">
                <label >Cognome</label>
                <input type="text" class="form-control" name="cognome" value="<?php if(isset($_POST['cognome'])){echo $_POST['cognome'];
                $_SESSION['cognome']=$_POST['cognome'];} ?>">
            </div>
            <div class="mb-3">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" name="email" autocomplete="off" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
                <span class="text-danger"><?= $ErrorEmail;?></span>
            </div>
            <div class="mb-3">
                <label for="inputPassword4">Password corrente</label>
                <span class="text-danger">* fare il logout dopo aver premuto sul bottone Aggiorna<?= $ErrorPassword;?></span>
                <input type="password" class="form-control" autocomplete="off" name="passwordCorrente" value="<?php if(isset($_POST['passwordCorrente'])){echo $_POST['passwordCorrente'];}else{echo "";} ?>">
                
            </div>
            <div class="mb-3">
                <label for="inputPassword4">nuova password</label>
                <input type="password" class="form-control" name="NuovaPassword" value="<?php if(isset($_POST['NuovaPassword']))echo $_POST['NuovaPassword']; ?>">
            </div>
            <div class="mb-3">
                <label for="inputPassword4">conferma Password</label>
                <input type="password" class="form-control" name="ConfermaPassword" value="<?php if(isset($_POST['ConfermaPassword']))echo $_POST['ConfermaPassword']; ?>">
                <span class="text-danger"><?= $ErrorNuovaPassword;?></span>
            </div>

            <h2>completa i dati del tuo profilo</h2>
            <div class="mb-3">
                <label >telefono</label>
                <span class="text-danger"><?= $ErrorTel;?></span>
                <input type="tel" class="form-control" name="telefono" value="<?php if(isset($_POST['telefono']))echo $_POST['telefono']; ?>">
            </div>
            <div class="mb-3">
                <label >fax</label>
                <span class="text-danger"><?= $ErrorFax;?></span>
                <input type="tel" class="form-control" name="fax" value="<?php if(isset($_POST['fax']))echo $_POST['fax']; ?>">
            </div>
            <div class="mb-3">
                <label >indirizzo</label>
                <input type="text" class="form-control" name="indirizzo" value="<?php if(isset($_POST['indirizzo']))echo $_POST['indirizzo']; ?>">
            </div>
            <div class="mb-3">
                <label >numero civico</label>
                <span class="text-danger"> <?= $ErrorCiv;?></span>
                <input type="text" class="form-control" name="numero_civico" value="<?php if(isset($_POST['numero_civico']))echo $_POST['numero_civico']; ?>">
            </div>
            <div class="mb-3">
                <label >cap</label>
                <span class="text-danger"> <?= $Errorcap;?></span>
                <input type="number" class="form-control" name="cap" value="<?php if(isset($_POST['cap']))echo $_POST['cap']; ?>">
            </div>

            <button type="submit" class="btn btn-primary" name="aggiorna">Aggiorna</button>
        </form>

        </div>
        <?php 
            if($Errormessage != ''){
                echo "<div class=\"alert alert-danger\" role=\"alert\">
                    $Errormessage </div>";
            }
        ?>

    </div>
</div>
<?php
    include("../Footer.php");
?>
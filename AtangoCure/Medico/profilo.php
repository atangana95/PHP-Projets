<?php 
$titre ="Profilo";
    include("../Headers/Header_medici.php");
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
            $sql = "SELECT * FROM $tabellaMedici WHERE  cognome = ? AND nome = ? ";
            $Users = $database->prepare($sql);
            $Users->execute(array($_SESSION['cognome'],$_SESSION['nome']));
            if($Users->rowCount()>0){
                while($User = $Users->fetch()){
                    $id = $User['ID_medico'];
                    $codice_fisc = $User['codice_fiscale'];
                    $nome = $User['nome'];
                    $cognome = $User['cognome'];
                    $tel = $User['telefono'];
                    $genere = $User['genere'];
                    $cod_specia = $User['cod_specia'];
                }        
            }        
        ?>
        <div class="col-md-4 card bg-dark text-light">
            <div class="card-body">
                <h4>I miei dati registrati</h4>
                <p>codice fiscale: <?= $codice_fisc ?></p>
                <p>Nome: <?= $nome ?></p>
                <p>Cognome: <?= $cognome ?></p>
                <p>telefono: <?= $tel?></p>
                <p>genere: <?=$genere ?></p>
                <p>cod_specia: <?= $cod_specia?></p>
            </div>
        </div>
        <?php 
            $Errormessage = '';
            $ErrorTel ='';
            $ErrorGen = '';
            $Errorcod_specia = '';
            $ErrorCodice_fisc = '';
            $count = 0;
            if(isset($_POST['aggiorna'])){
                if(isset($_POST['codice_fiscale'])){
                    $codice_fiscale = $_POST['codice_fiscale'];
                    if($codice_fiscale!= $codice_fisc){
                        $ErrorCodice_fisc = 'il codice fiscale corrente appena inserita non  corrisponde con il codice fiscale di registrazione';
                    }else{
                        if(!empty($_POST['nome'])){
                            $name = htmlspecialchars($_POST['nome']);
                            $nuovoNome =$database->prepare("UPDATE $tabellaMedici SET nome=? WHERE ID_medico=?");
                            $nuovoNome->execute(array($name, $id));
                            $_SESSION['nome'] = $name;
                        }
                        if(!empty($_POST['cognome'])){
                            $surname = htmlspecialchars($_POST['cognome']);
                            $nuovoNome =$database->prepare("UPDATE $tabellaMedici SET cognome=? WHERE ID_medico=?");
                            $nuovoNome->execute(array($surname,$id));
                            $_SESSION['cognome'] = $surname;
                        }
                        if(!empty($_POST['telefono'])){
                            if(preg_match("/^([0-9]{10})$/",$_POST['telefono'])){
                                $telef = htmlspecialchars($_POST['telefono']);
                                $sql = "SELECT telefono FROM $tabellaMedici ";
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
                                        $nuovoNome =$database->prepare("UPDATE $tabellaMedici SET telefono=? WHERE ID_medico=?");
                                        $nuovoNome->execute(array($telefono,$id));
                                    endif;
                                }        

                            }else{
                                $ErrorTel = 'numero di telefono non valido!';
                                $count += 1;
                            }
                        }            
                        if(!empty($_POST['genere'])){
                            $genere = htmlspecialchars($_POST['genere']);
                            $nuovoNome =$database->prepare("UPDATE $tabellaMedici SET genere=? WHERE ID_medico=?");
                            $nuovoNome->execute(array($genere,$id));
                        }
                        if(!empty($_POST['cod_specia'])){
                            if(preg_match("/^([0-9]{5})$/",$_POST['cod_specia'])){
                                $cod_specia = htmlspecialchars($_POST['cod_specia']);
                                $nuovoNome =$database->prepare("UPDATE $tabellaMedici SET cod_specia=? WHERE ID_medico=?");
                                $nuovoNome->execute(array($cod_specia,$id));
                            }else{
                                $Errorcod_specia = ' cod_specia non valido! il cod_specia deve essere composto di 5 numeri';
                            }
                        }        
                    }
                }else{
                    $ErrorCodice_fisc = 'questo campo deve essere obbligatoriamente compilato';
                }
            }
        ?>
        <div class="col-md-6">
        <form method="post" >
            <h2>Modifica i dati di registrazione</h2>
            <div class="mb-3">
                    <label >codice fiscale</label>
                    <input type="text"  name="codice_fiscale" value="<?php if(isset($_POST['codice_fiscale']))echo $_POST['codice_fiscale']; ?>"/>
                    <span class="text-danger">* fare il logout dopo aver premuto sul bottone Aggiorna<?= $ErrorCodice_fisc;?></span>
                </div>

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
            <h2>completa i dati del tuo profilo</h2>
            <div class="mb-3">
                <label >telefono</label>
                <span class="text-danger"><?= $ErrorTel;?></span>
                <input type="tel" class="form-control" name="telefono" value="<?php if(isset($_POST['telefono']))echo $_POST['telefono']; ?>">
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
                <span class="text-danger"> <?= $ErrorGen;?></span>           
            </div>
            <div class="mb-3">
                <label >specializzazione</label>
                <span class="text-danger"> <?= $Errorcod_specia;?></span>
                <select  name="specia">
                <?php 
                    $specia = $database->query("SELECT * FROM $tabellaSpecializzazioni");
                    if($specia->rowCount()>0){
                        while($Dati = $specia->fetch()){
                            $codice = $Dati['codice_specia'];
                            $descrizione = $Dati['descrizione']; ?>
                            <option value="<?=$codice ?>"><?=$descrizione ?></option>

                <?php   }
                    }
                ?> 
                </select>       
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


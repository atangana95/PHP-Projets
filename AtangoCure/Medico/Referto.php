<?php
    $titre ="Inserzione referto";
    include("../Headers/Header_medici.php");
    $prenotazione = $_GET['ID_prenotazione'];
?>
<body id="wel">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index_Medico.php"><img src="../logo/AtangoCure 1.jpg" class="rounded-circle" alt="Logo" width="90" height="70"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
                <li class="nav-item active">
                    <a class="nav-link" href="visiteGiornaliere.php">visite giornaliere <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="profilo.php">Profilo</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="appuntamenti.Settimanali.php">appuntamenti settimanali</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="visiteEffettuate.php">visite effettuate</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <script>
        function ConvalidaForm() {
            let referto = document.forms["EsitoVisita"]["referto"].value;
            if (referto == "") {
                alert("deve assolutamente inserire l'esito della visita");
                return false;
            }
        }
    </script>
    <h2>nel caso il paziente non si sia presentato per la visita, inserite semplicemente la parola "mancata"!</h2>
    <form action="RefertoAction.php" method="post" name="EsitoVisita" onsubmit="return ConvalidaForm()">
        <label for="referto">Esito visita</label>
        <input type="text" name="referto" id="referto" style="width:80%;">
        <span class="text-danger">* </span><br>
        <input type="hidden" name="prenotazione" value="<?=$prenotazione ?>">
        <button type="submit" class="btn btn-primary" name="invio">Invia</button>
    </form>
<?php    
    include("../Footer.php");
?>

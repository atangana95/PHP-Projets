<?php 
    $titre='welcome;'
?>
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title><?= $titre ?></title>
        <link href="mystyle.css" type="text/css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">    
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>    
    </head>
    <body id="wel">
        <div class="jumbotron">
            <div class="container">
                <nav>
                    <img src="logo/AtangoCure 1.jpg" class="rounded-circle" alt="Logo" width="150" height="120">
                </nav>
                <h1 class="display-3">Benvenuto nella clinica AtangoCure!</h1>
                <div class="btn btn-warning btn-lg btn-block mb-2">
                        <a href="Action/Group_Action.php">crea un nuovo gruppo</a>
                </div>
                <h4>Ciao! Per accedere alla piattaforma devi scegliere una delle voci sotto e procedere con l'autentificazione.
                    Nel caso non sei registrato, dovrai prima fare la registrazione e poi tornare a fare il login.

                </h4>
                
            </div>
        </div>
        <div class="row" style="align-content: center;">
            <div class="ml-3 card bg-dark text-white">
                <img src="logo\Doctor_Male_icon-icons.com_75051.png" alt="medico" width="180">
                <div class="contain">
                    <h4><b>Medico</b></h4>
                    <p>clicca qui per l'accesso medici che sia per login o registrazione </p>
                    <a href="Medico\Login_Medici.php" class="btn btn-primary">vai</a>
                </div>
            </div>
            <div class="ml-3 card bg-secondary text-white">
                <img src="logo\patient.png" alt="paziente" width="180">
                <div class="contain">
                    <h4><b>Paziente</b></h4>
                    <p>clicca qui per l'accesso paziente che sia per login o registrazione</p>
                    <a href="Paziente\Login_Pazienti.php" class="btn btn-success">vai</a>
                </div>
            </div>
        </div>
<?php
    include("Footer.php");
?>

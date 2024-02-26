<?php
  ini_set('display_errors', true);
  error_reporting(E_ALL);

  $server="mysql:host=localhost";
  $tabellaMedici = "Medici";
  $tabellaPazienti = "Pazienti";
  $tabellaVisite = "Visite";
  $tabellaSpecializzazioni = "Specializzazioni";
  $tabellaMediciSpecializzazioni = "Medici_Specializzazioni";
  $tabellaGeneri = "Generi";
  $tabellaPrenotazioni = "Prenotazioni";
  $tabellaTipiCC = "TipiCC";
  $tabellaPrestazioni = "Prestazioni";
  $user = "root";
  $passw = "";
  $dbName = 'mysql:host=localhost; dbname=AtangoCure;charset=utf8';
  $database =  new PDO($dbName,$user,$passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
  
  ?>
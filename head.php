<?php

abstract class SESSIONE {
    private static $flag = false;
    public static function attiva() : bool { return self::$flag; }
    public static function on() : void { self::$flag = true; }
    public static function off() : void { self::$flag = false; }
    public static function switch() : bool { return self::$flag != self::$flag; }
}

if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}

if (!empty($_SESSION['TIME']))
    SESSIONE::on();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

    <!-- TITOLO DELLA PAGINA -->
        <title>uniHelp</title>

        <style type="text/css">
            * {
                max-width:100%;
            }
            /*<![CDATA[*/
             body {
              text-align: center;
              color: #336699;
              font-family: Arial, Helvetica, sans-serif;
              font-size: 48px;
              font-weight: bold;
            }
             h2.c1 {
              color: #CC6600;
              font-size: 24px;
              font-weight: lighter;
            }
             p.c2 {
              color: #CC6600;
              font-size: 13px;
              font-weight: lighter;
            }
            /*]]>*/
            </style>

    <!-- META-DATI -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8"> <!-- CHARSET -->
        <meta name="description" content="uniHelp"> <!-- DESCRIZIONE -->
        <meta name="keywords" content="uni,university,esami,exams,laurea"> <!-- PAROLE CHIAVE MOTORI DI RICERCA -->
        <meta name="author" content="Luca Ruggirello, Simone Barandoni"> <!-- AUTORI -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- AGGIUSTO LA VISUALE IN BASE ALLO SCHERMO -->		

    <!-- LINK UTILI -->
        <link rel="author" href="" /> <!-- LINK AL SITO DELL'AUTORE -->
        <link rel="license" href="" /> <!-- LINK ALLE INFO SUL COPYRIGHT -->
        <link rel="help" href="" /> <!-- LINK A INFO UTILI -->					

    <!-- ESEGUO IN CASO DI JAVASCRIPT DISABILITATO -->
        <noscript>
            <!-- LINK A INFO UTILI SULL'ABILITAZIONE DI JAVASCRIPT -->
            Per avere a disposizione tutte le funzionalità di questo sito è necessario abilitare
            Javascript. Qui ci sono tutte le <a href="https://www.enable-javascript.com/it/">
            istruzioni su come abilitare JavaScript nel tuo browser</a>.
            <hr>			
            For full functionality of this site it is necessary to enable JavaScript.
            Here are the <a href="https://www.enable-javascript.com/">
            instructions how to enable JavaScript in your web browser</a>.
        </noscript>

    <!-- RISORSE ESTERNE -->
        <link rel="icon" href="img/favicon.gif" type="image/x-icon" /> <!-- FAVICON -->
        <!-- CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">		
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous"> <!-- IMPORTO AWESOME ICONS -->
        <!-- SCRIPT -->		
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="https://www.w3schools.com/lib/w3.js"></script>
    <!-- RISORSE INTERNE -->
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href= "css/style.css"/>
        <link rel="stylesheet" type="text/css" href="css/slider-style.css">
        <!-- SCRIPT -->

    </head>
    <body>
        <header>
            <?php require_once("navbar.php"); ?>
    
    
<!DOCTYPE html>
<html>
    <head>
        <title>Protected area</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css" />
        <style>
            .flex-container {
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 50px auto auto auto;
                height: 300px;
            }

            .flex-container>div {
                border: 1px grey solid;
                padding: 0px 30px 30px 30px;
                box-shadow: 10px 10px 10px grey;
            }
            a:visited {
                color: blue;
            }
        </style>
    </head>
    
    <body class="flex-container">
        <div style="text-align: left">
            <p><a href="index.html">..Indietro</a></p><center><h1>aruba_mail.php</h1></center>

<?php

//error_reporting(E_ALL);
    
    if (filter_var($_GET["to"], FILTER_VALIDATE_EMAIL)) {

        // Genera un boundary
        $mail_boundary = "=_NextPart_" . md5(uniqid(time()));

        $to = $_GET["to"];
        $subject = "Testing e-mail";
        $sender = "postmaster@unihelp.it";


        $headers = "From: $sender\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative;\n\tboundary=\"$mail_boundary\"\n";
        $headers .= "X-Mailer: PHP " . phpversion();

        // Corpi del messaggio nei due formati testo e HTML
        $text_msg = "messaggio in formato testo";
        $html_msg = "<b>messaggio</b> in formato <p><a href='http://www.aruba.it'>html</a><br><img src=\"http://hosting.aruba.it/image_top/top_01.gif\" border=\"0\"></p>";

        // Costruisci il corpo del messaggio da inviare
        $msg = "This is a multi-part message in MIME format.\n\n";
        $msg .= "--$mail_boundary\n";
        $msg .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
        $msg .= "Content-Transfer-Encoding: 8bit\n\n";
        $msg .= "Questa è una e-Mail di test inviata dal servizio Hosting di Aruba.it per la verifica del corretto funzionamento di PHP mail()function.

        Aruba.it";  // aggiungi il messaggio in formato text

        $msg .= "\n--$mail_boundary\n";
        $msg .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
        $msg .= "Content-Transfer-Encoding: 8bit\n\n";
        $msg .= "Questa è una e-Mail di test inviata dal servizio Hosting di Aruba.it per la verifica del corretto funzionamento di PHP mail()function.

        Aruba.it";  // aggiungi il messaggio in formato HTML

        // Boundary di terminazione multipart/alternative
        $msg .= "\n--$mail_boundary--\n";

        // Imposta il Return-Path (funziona solo su hosting Windows)
        ini_set("sendmail_from", $sender);

        // Invia il messaggio, il quinto parametro "-f$sender" imposta il Return-Path su hosting Linux
        if (mail($to, $subject, $msg, $headers, "-f$sender")) { 
            echo "Mail inviata correttamente!<br><br>";//Questo di seguito è il codice sorgente usato per l'invio della mail:<br><br>";
            //highlight_file($_SERVER["SCRIPT_FILENAME"]);
            //unlink($_SERVER["SCRIPT_FILENAME"]);
        } else { 
            echo "<br><br>Recapito e-Mail fallito!";
        }
        
    } else {
        
        $mail_err = empty($_GET["to"]) ? "" : "*invalid email!";

?>

<form action="aruba_mail.php" method="get">
    <label for="to"><?php echo $mail_err; ?></label><br>
    <input type="text" name="to" />
    <input type="submit" value="Invia" />
</form>



<?php } ?>

        </div>
    </body>
</html>
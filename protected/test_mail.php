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
            <p><a href="index.html">..Indietro</a></p><center><h1>test_mail.php</h1></center>

<?php

function invia_mail($to) { //versione giusta
    
    // CREATE MAIL_BOUNDARY
    $mail_boundary = "=_NextPart_" . md5(uniqid(time()));
	
    $subject = "Attiva il tuo profilo"; 
    $sender = "unihelp.registration@unihelp.it";	 // importante il sender deve contenere solo l'email

    $headers = "From: uniHelp <$sender>\n"; // specificare qui il nome che si desidera mostrare al destinatario
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-Type: multipart/alternative;\n\tboundary=\"$mail_boundary\"\n";
    $headers .= "X-Mailer: PHP " . phpversion();

    // Corpi del messaggio nei due formati testo e HTML
    $text_msg = "Hey tu!";
    $html_msg = "<html><body><h4>Hey tu!</h4></body></html>";

    // Costruisci il corpo del messaggio da inviare
    $msg = "This is a multi-part message in MIME format.\n\n";
    $msg .= "--$mail_boundary\n";
    $msg .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
    $msg .= "Content-Transfer-Encoding: 8bit\n\n";
    $msg .= $text_msg;  // aggiungi il messaggio in formato text

    $msg .= "\n--$mail_boundary\n";
    $msg .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
    $msg .= "Content-Transfer-Encoding: 8bit\n\n";
    $msg .= $html_msg;  // aggiungi il messaggio in formato HTML

    // Boundary di terminazione multipart/alternative
    $msg .= "\n--$mail_boundary--\n";

    // Imposta il Return-Path (funziona solo su hosting Windows)
    ini_set("sendmail_from", $sender);

    // Invia il messaggio, il quinto parametro "-f$sender" imposta il Return-Path su hosting Linux
    return mail($to, $subject, $msg, $headers, "-f$sender");
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET["to"])){
            if (filter_var($_GET["to"], FILTER_VALIDATE_EMAIL)) {
                    if (invia_mail($_GET["to"])) { 
                        echo "Mail inviata correttamente!<br><br>";
                    } else { 
                        echo "<br><br>Recapito e-Mail fallito!";
                    }
                    
            } else {
                    echo "*invalid email<br><br>";
                    ?>  
                        <form action="test_mail.php" method="get">
                            <input type="text" name="to" />
                            <input type="submit" />
                        </form> 
                    <?php
            }
    } else {
        
        ?>
            <form action="test_mail.php" method="get">
                <input type="text" name="to" />
                <input type="submit" />
            </form> 
        <?php
       
    }
    
} else {
	echo "*no request<br><br>";
        ?>
            <form action="test_mail.php" method="get">
                <input type="text" name="to" />
                <input type="submit" />
            </form> 
        <?php
}

?>
            
        </div>
    </body>
</html>
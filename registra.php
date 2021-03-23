<?php

//error_reporting(0);

$user_pattern ="/^[a-zA-Z0-9]*$/";
$pass_pattern ="/^[a-zA-Z0-9]*$/";
$mail = $pass = $repass = $user = "";
$mail_err = $pass_err = $repass_err = $user_err = ""; 

$xml_fname = "users_to_add.xml";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$mail_err = empty($_POST["mail"]) ? "Mail richiesta" : "" ;
	$pass_err = empty($_POST["pass"]) ? "Password richiesta" : "" ;
	$user_err = empty($_POST["user"]) ? "Username richiesto" : "" ;	
	
	$mail = pulisci_input($_POST["mail"]);
	$pass = pulisci_input($_POST["pass"]);
	$repass = pulisci_input($_POST["repass"]);
	$user = pulisci_input($_POST["user"]);
	
	
	if(!preg_match($user_pattern, $user))
		$user_err = ($user_err == "") ? "Puo' contenere solo lettere e numeri" : $user_err;
	if((strlen($user) < 8) or (strlen($user) > 16))
		$user_err = ($user_err == "") ? "Lunghezza consentita tra 8 e 16" : $user_err;
		
	if(!preg_match($pass_pattern, $pass))
		$pass_err = ($pass_err == "") ? "Puo' contenere solo lettere e numeri" : $pass_err;
	if((strlen($pass) < 8) or (strlen($pass) > 16))
		$pass_err = ($pass_err == "") ? "Lunghezza consentita tra 8 e 16" : $pass_err;
	
		
	if($pass_err == ""){
		if($repass == "")
			$repass_err = "Reimmetti la password";
		else
			$repass_err = ($pass != $repass) ? "Le due password non coincidono" : "";
	}
	if(!filter_var($mail, FILTER_VALIDATE_EMAIL))
		$mail_err = ($mail_err == "") ? "Indirizzo mail non valido" : $mail_err;

	if(empty($mail_err) and empty($user_err) and empty($pass_err) and empty($repass_err)) {
		
		try { 
                    registra_utente($mail, $user, $pass, $xml_fname);
                    header("Location: confermaRegistra.php");
                    exit();
                }
		catch (Exception $e) { echo "Oops, qualcosa e' andato storto...<br><br><em>".$e->getMessage()."</em>"; }
		
	} 
	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>UniHelp.it</title>
	</head>
    <?php require("head.php"); ?>
    
	<body>
        <header>
			<?php require("navbar.php");  //IMPORTO LA NAVBAR ?>
		</header>
        <div class="height"> 
            <div class="row sfondoSfocato sfondoSfocato2 marginetop">
				<div class="col-sm-6 col-sm-offset-3" class="view">
					<h1 class="titleOther">UniHelp</h1>
				</div>
			</div>
			<div class="container marginetop">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-2" class="view">
						<h1 class="subTitle">Registrati al sito</h1>
					</div>
					
				</div>
			</div>
			<div class="container">
				 <br>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <label for="mail"><b>Email* </b></label>
                            <input type="text" name="mail" autofocus style="width:50%;" maxlength="100" value="<?php echo $mail; ?>" placeholder="Scrivi la tua email.." ><span class="error"><?php echo $mail_err;?></span>
                        </div>	
                    </div>				
					<br>
					<div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <label for="pass" autocomplete="off"><b>Crea una password*</b></label>
                            <input type="password" name="pass" autofocus style="width:50%;" maxlength="100" value="<?php echo $pass; ?>" placeholder="Password.." >
                            <span class="error"><?php echo $pass_err;?></span>
                        </div>
                    </div>				
					<br>
					<div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <label for="repass" autocomplete="off"><b>Ripeti la password* </b></label>
                            <input type="password" name="repass" autofocus style="width:50%;" maxlength="100" value="<?php echo $repass; ?>"placeholder="Password.." >
                            <span class="error"><?php echo $repass_err;?></span>
                        </div>
                    </div>				
					<br>
					<div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <label for="user" autocomplete="off"><b>Crea un nickname* </b></label>
                            <input type="text" name="user" autofocus style="width:50%;" maxlength="100" value="<?php echo $user; ?>" placeholder="Nickname.." >
                            <span class="error"><?php echo $user_err;?></span>
                        </div>
                    </div>				
					<br>
					<div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <input type="submit" value="Registrati" />
                        </div>
					</div>				
					<br>
					<div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <h4>Se hai già un account, <a href="login.php">clicca qui.</a></h4>
                        </div>
                    </div>				
				</form>
			</div>
			<br>
		</div>
		<br>		
	</body>
</html>

<?php

function registra_utente($mail, $user, $pass, $fname) {
	
	$xml = simplexml_load_file($fname);
	if ($xml == false) throw new Exception("Unable to load xml file");

	//check if alreadyd exists
	$already_exists_flag = 0;
	foreach($xml->registra->children() as $child){
		$already_exists_flag |= $child['mail'] == $mail;
		$already_exists_flag |= $child['user'] == $user;
	}
	
	if($already_exists_flag) {throw new Exception("Utente gia' registrato"); return 0;}

	// se invece l'account non è già registrato procedo
	// genero il codice di verifica che invierò per email
	$verify = sha1(date("Y-m-d H:i:s:u")); 
	
	$utente = $xml->registra->addChild("utente");
	
	$utente->addAttribute("mail", $mail);
	$utente->addAttribute("user", $user);
	$utente->addAttribute("pass", sha1($pass));
	$utente->addAttribute("verify", $verify);
	$utente->addAttribute("time", time());
	
	$xml->saveXML($fname); //tmp, rimettere giu'
	
	//echo "Invio mail non disponibile, <a href=\"attiva.php?key=$verify\">CLICCA QUI</a> per attivare il tuo nuovo account"; //togliere
	
	if (!invia_mail($mail, $verify)) {		
		throw new Exception("Impossibile inviare email");
		return 0;
	}
	
	$xml->saveXML($fname); // salvo il file */
	
	//return true;
	
	echo "Registrazione avvenuta!<br>Ti verrà inviata un email  di verifica a <em>$mail</em><br>";
	
	return true;
}

function invia_mail($to, $key) { //versione giusta
    
    // CREATE MAIL_BOUNDARY
    $mail_boundary = "=_NextPart_" . md5(uniqid(time()));
	
    $subject = "Attiva il tuo profilo"; 
    $sender = "unihelp.registration@unihelp.it";	 // importante il sender deve contenere solo l'email

    $headers = "From: uniHelp <$sender>\n"; // specificare qui il nome che si desidera mostrare al destinatario
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-Type: multipart/alternative;\n\tboundary=\"$mail_boundary\"\n";
    $headers .= "X-Mailer: PHP " . phpversion();

    // Corpi del messaggio nei due formati testo e HTML
    $text_msg = "Link: http://www.unihelp.it/attiva.php?key=$key";
    $html_msg = "<html>
                    <body>
                        <div>   
                            <div>
                                <h1>UniHelp.it</h1>
                            </div>
                            <div>
                                <h1>Attiva il tuo profilo</h1>
                            </div>
                            <div>
                                <hr><br>
                                <div>
                                    <h4><b>Ciao, premi il link sottostante per confermare la tua email e attivare il tuo account (entro 24h)</b></h4>
                                </div>				
                                <br>

                                <div>
                                    <h4><a href=\"http://www.unihelp.it/attiva.php?key=$key\">Premi qui</a></h4>
                                </div>
                            </div>
                            <br>
                        </div>
                        <br>
                    </body>
                </html>";

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

function pulisci_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>
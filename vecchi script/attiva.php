<?php

error_reporting(0);

$xml_fname = "users_to_add.xml";
$user = $mail = $pass = $key = $time = null;

try {
	
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
			
		if (empty($_GET["key"])) throw new Exception("Empty request to the server");
		
		$xml = simplexml_load_file($xml_fname);
		if ($xml == false) throw new Exception("Unable to load xml file");
		
		foreach($xml->registra->children() as $child){
			if ($child["verify"] == $_GET["key"]){ 
				$user = $child["user"];
				$mail = $child["mail"];
				$pass = $child["pass"];					
				$key = $_GET["key"];
				$time = $child["time"];
				
				$tmp=dom_import_simplexml($child);
				$tmp->parentNode->removeChild($tmp);
				$xml->asXML($xml_fname);
				
				if ( (time() - $time) > 86400 )	throw new Exception("Registration link expired");
			}
		}
		
		if($key == null) throw new Exception("No key corrispondance");
		
		//se invece va tutto bene, proseguo alla registrazione sul dba_close
		
		// query mysqli
		$connessione = null;
		if (!($connessione = connessione_db())) throw new Exception("(Mysqli) Unable to connect to the db"); 
		
		if (!registra_utente($connessione, $mail, $user, $pass)) throw new Exception("(Mysqli) Unable to execute the insertion query");
		
		echo "<!DOCTYPE html>
				<html lang=\"it\">
					<body>
						<div>   
							<div>
								<h1>UniHelp</h1>
							</div>
							<div>
								<h1>Hai confermato il tuo profilo</h1>
							</div>
							<div>
								<hr><br>
								<div>
									<h4><b>Sei pronto a iniziare, accedi al tuo profilo <a href=\"login.php\">$user</a></b></h4>
								</div>				
								<br>
								 
							</div>
							<br>
						</div>
						<br>		
					</body>
				</html>";
		
	} else throw new Exception("No request has been made");
}

catch (Exception $e) {
	echo "Exception: ".$e->getMessage();
}

finally {
	echo "";
}



function connessione_db () {
		
	// CREDENZIALI	
	$db_server = "89.46.111.183";
	$db_user = "Sql1421339";
	$db_pass = "8288gd1s54";
	$db_nome = "Sql1421339_1";
	//$db_porta = 3306;
	
	return $con = new mysqli($db_server, $db_user, $db_pass, $db_nome);
}

function registra_utente(&$con, $mail, $user, $pass) {
	
	$query = "INSERT INTO utenti (attivo, mail, user, pass) "
			."VALUES (TRUE, '$mail', '$user', '$pass');";
	
	return $con->query($query);	
}

?>
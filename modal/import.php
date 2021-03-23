<?php
	
	$lista_modal_di_base = array(
		"login",
		"profilo",
		"recensione"
	);
	
	$estensione = array("php", "html", "htm", "js", "css");
	
	foreach ( $lista_modal_di_base as $i => $v) {
		require($v . "." . $estensione[0]);
	}
	
?>
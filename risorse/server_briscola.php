<?php

header("Content-Type: application/json; charset=UTF-8");

if (!empty($_GET["lb"]) and !empty($_GET["pl"])) {
    
    if ($_GET["op"] == 1) { // leggi
    
        $tmp = fopen($_GET["lb"].".json", "r") or die();
        echo "richiestaCompletata(".fread($tmp, filesize($_GET["lb"].".json")).")";
        fclose($tmp);
        
    } else if ($_GET["op"] == 2 and !empty($_GET["obj"])) { //scrivi
        
        $tmp = fopen($_GET["lb"].".json", "w") or die();
        fwrite($tmp, json_encode($_GET["obj"], false));
        fclose($tmp);
    }
}

?>
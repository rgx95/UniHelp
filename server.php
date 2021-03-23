<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header("Content-Type: application/json; charset=UTF-8");

if (!empty($_GET["data"])) { //scrivi
        
    $tmp = fopen("file.json", "w") or die();
    fwrite($tmp, json_encode($_GET["obj"], false));
    fclose($tmp);
    
    echo "{'response':true}";
}
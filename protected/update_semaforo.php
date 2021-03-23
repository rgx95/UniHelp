<!DOCTYPE html>
<html>
    <head>
        <title>update semafori</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css" />
    </head>
    
    <style>
        .flex-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 30%;
            margin: 50px auto auto auto;
        }

        .flex-container>div {
            border: 1px grey solid;
            padding: 15px 30px 30px 30px;
            box-shadow: 10px 10px 10px grey;
        }
    </style>
    
    <body class="flex-container">  
        <div style="text-align: center">
            <p style="text-align: left"><a href="index.html">..Indietro</a></p>
<?php

error_reporting(0);

if ($_POST["pass"] == "carlo"){

$files = array_slice(scandir('../'), 2);

$json = array();

echo "\t\t\t<h3>Nuova lista di semafori</h3>\r\n"
        . "\t\t\t<ol start=\"0\" type=\"1\" style=\"text-align:left\">\r\n";

foreach ($files as $i => $v) {
    
    // check if no extension
    if (!strpos($v, ".php", -4))
        continue;        
    
    array_push($json, array(false, $v));
    
    echo "\t\t\t\t<li>[ <b>false</b>, <em>\"$v\"</em> ]</li>\r\n";
}

echo "\t\t\t</ol>\r\n"
        . "\t\t</div>";

$json = json_encode($json);

$tmpfile = fopen("semaforo_json.js", "w") or die("Unable to open -w file!");
fwrite($tmpfile, $json);
fclose($tmpfile);

} else {
    
    $pass_err = "";
    
    if (!empty($_POST["pass"]))
        $pass_err = "*password errata!";
            
    echo "\t\t\t<form action=\"".htmlspecialchars($_SERVER["PHP_SELF"])."\" method=\"post\">\r\n"
            . "\t\t\t\t<h3>Aggiorna semafori:</h3>\r\n"
            . "\t\t\t\t<label for=\"pass\">".$pass_err."</label><br>\r\n"
            . "\t\t\t\t<input type=\"password\" name=\"pass\" value=\"".$_POST["pass"]."\" placeholder=\"immetti password per continuare\"/>\r\n"
            . "\t\t\t\t<input type=\"submit\" value=\"Aggiorna json\" />\r\n"
            . "\t\t\t</form>\r\n"
            . "\t\t</div>";
}

?>

       
    </body>
</html>
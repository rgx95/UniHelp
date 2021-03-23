<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <style>
        .flex-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80%;
            margin: 50px auto 50px auto;
        }

        .flex-container>div {
            border: 1px grey solid;
            padding: 20px 50px 30px 50px;
            box-shadow: 10px 10px 10px grey;
            overflow: auto;
        }

        ul { list-style: none; }

        ul li::after {
            content: "\2022";  /* Add content: \2022 is the CSS Code/unicode for a bullet */
            font-weight: bold; /* If you want it to be bold */
            /*display: inline-block; /* Needed to add space between the bullet and the text */
            width: 0em; /* Also needed for space (tweak if needed) */
            margin-right: 0em; /* Also needed for space (tweak if needed) */
            font-size: 48pt;
        }

    </style>
    
    <body class="flex-container"> 
        <div>
            <p><a href="index.html">..Indietro</a></p><h1>Attualmente <span style="color:green; font-size: 24pt;">liberi</span> / <span style="color:red; font-size: 24pt;">occupati</span>:</h1>
<?php

error_reporting(0);

$tmpfile = fopen("semaforo_json.js", "r") or die("Unable to open -r file!");
$semafori = json_decode(fread($tmpfile,filesize("semaforo_json.js")));
fclose($tmpfile);

if ($_SERVER["REQUEST_METHOD"] === "GET") {
	if (!empty($_GET["indice"])){
		
		$indice = $_GET["indice"] - 1;
		
		$semafori[$indice][0] = !($semafori[$indice][0]);
		
		$tmpfile = fopen("semaforo_json.js", "w") or die("Unable to open -w file!");
		fwrite($tmpfile, json_encode($semafori));
		fclose($tmpfile);	

		header("Refresh:0; url=semaforo.php");
		
	}
}

echo "\t\t\t<h1>\r\n\t\t\t\t<ul>\r\n";

foreach ($semafori as $indice => $semaforo) {
	$pagina = $semaforo[1];
	$get = "?indice=".($indice + 1);
	$colore = ($semaforo[0]) ? "red" : "green";
	
	echo "\t\t\t\t\t<li style=\"color:".$colore."\"><a href=\"semaforo.php".$get."\" style=\"color:".$colore."\">".$pagina."</a></li>\r\n";
}

echo "\t\t\t\t</ul>\r\n\t\t\t</h1>\r\n";

header("Refresh:3; url=semaforo.php"); ?>
        </div>
    </body>
</html>
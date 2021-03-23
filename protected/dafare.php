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
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            width: 90%;
            height: 30%;
            margin: 50px auto 50px auto;
            box-shadow: 10px 10px 10px grey;
            border: 1px grey solid;
        }

        .flex-container>div.testa {
            width: 100%;
            padding: 15px 30px 30px 30px;
        }
        
        .flex-container>div.coda {
            width: 100%;
            padding: 15px 30px 30px 30px;
        }
        
        .flex-container>div.corpo {
            width: 100%;
            padding: 15px 30px 30px 30px;
            
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
        
        /* */
        div.dafare {
            position: relative;
            width: 250px;
            height: 350px;
            border: 0px #cccccc solid;
            box-sizing: border-box;
            box-shadow: 0px 0px 10px #cccccc;
            margin: 10px;
        }                
        div.dafare>div {   
            position: absolute;
            margin: 0px 0px auto 0px;
            width: 100%;
            box-sizing: border-box;
            padding: 0.1em;
            font-size: 0.75em;
            vertical-align: middle;
        }                
        div.dafare>div.testa{                    
            top: 0em;        
            height: 1.5em;
            background: #cccccc;
        }
        div.dafare>div.corpo{
            top: 1.5em;
            bottom: 4em;
            text-align: left;
            padding: 0 1em 0 1em;
            overflow: auto;
        }
            div.dafare>div.corpo>form>ul {
                list-style-type:none;
                padding-left:0.6em;
            }    
            div.dafare>div.corpo>form>ul>li {
                padding: 0.4em 0 0.4em 0.4em;
                display: inline-block;
                width: 80%; 
            }
            div.dafare>div.corpo>form>ul>input {
                font-size: 1em;
                height: 1.7em;
            }
        div.dafare>div.coda{
            background: #cccccc;
            bottom: 0em;
            padding: 1em;
        }
    </style>
    
    <body class="flex-container">  
        <div class="testa" style="text-align: center">
            <p style="text-align: left"><a href="index.html">..Indietro</a></p><center><h1>Cose da fare</h1></center>
        </div>
        <div class="corpo">
<?php

    $nome_liste = array("simone", "luca", "comune");
    $obj_liste = array();
    
    foreach ($nome_liste as $nome) {
        $tmp = fopen("liste/".$nome.".json", "r");
        $obj_liste[$nome] = json_decode(fread($tmp, filesize("liste/".$nome.".json")), JSON_OBJECT_AS_ARRAY);  
    }

    if (!empty($_GET["lista"])) {
        
        $lista = $obj_liste[$_GET["lista"]];
        
        if (!empty($_GET["del"])) { // se è settato del
            $del = $_GET["del"]-1;
            unset($lista["voci"][$del]);
            $tmp = fopen("liste/".$lista["nome"] . ".json", "w");
            fwrite($tmp, json_encode($lista, JSON_FORCE_OBJECT));
            fclose($tmp);
            
        } else if (!empty($_GET["add"])) { // se è settato add
            
            array_push($lista["voci"], $_GET["add"]);
            $tmp = fopen("liste/".$lista["nome"] . ".json", "w");
            fwrite($tmp, json_encode($lista, JSON_FORCE_OBJECT));
            fclose($tmp);
        }
        
        header("Location: dafare.php");
        exit;
    }

    foreach ($obj_liste as $lista) {
?>                    
            <div class="dafare">
                <div class="testa"><?php echo $lista["titolo"]; ?></div>
                <div class="corpo">
                    <form method="get" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <input type="hidden" name="lista" value="<?php echo $lista["nome"];?>">
                        <input type="hidden" id="<?php echo "riga_" . $lista["nome"];?>" name="del" value="-1">
                        <ul>
<?php 
        foreach (array_reverse($lista["voci"], TRUE) as $i => $voce) {
?>
                            <input type="submit" onmouseover="document.getElementById('<?php echo "riga_" . $lista["nome"];?>').value = '<?php echo $i+1; ?>'" value="x" >
                            <li><?php echo $voce;?></li> 
<?php
        }
?>
                        </ul>
                    </form>
                </div>
                <div class="coda">
                    <form method="get" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <input type="hidden" name="lista" value="<?php echo $lista["nome"];?>">
                        <input name="add" type="text" placeholder="Aggiungi nota..." maxlength="37" style="border: 0px; width: 80%; display: inline-block; ">
                        <input type="submit" style=" display: inline-block; " value="+">
                    </form>
                </div>
            </div>
<?php 
    }
?>   
        </div>
    </body>
</html>

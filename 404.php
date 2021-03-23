<!DOCTYPE html>
<html>
    <head>
        <title>404</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    
    <style>
        .flex-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 300px;
        }

        .flex-container>div {
            border: 1px grey solid;
            padding: 0px 30px 30px 30px;
            box-shadow: 10px 10px 10px grey;
        }
    </style>
    
    <body class="flex-container">
        <div style="text-align: left">
            <h1>uniHelp 404</h1>
            Oops! La pagina richiesta non esiste o non &egrave; raggiungibile.<br>   <br>    
            <p style="text-align: center"><input type="button" value="vai alla Home" onclick="window.location.replace('https://www.unihelp.it')" /></p>
        </div>
    </body>
</html>
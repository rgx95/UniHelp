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
            <p><a href="index.html">..Indietro</a></p><center><h1>md5.php</h1></center>

<?php 

error_reporting(0);

function crypt_apr1_md5($plainpasswd, $salt_get = "")
{
	$salt = "";
	
	if ($salt_get !== "")
		$salt = $salt_get;
	else
		$salt = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"), 0, 8);
	
    $len = strlen($plainpasswd);
    $text = $plainpasswd.'$apr1$'.$salt;
    $bin = pack("H32", md5($plainpasswd.$salt.$plainpasswd));
    for($i = $len; $i > 0; $i -= 16) { $text .= substr($bin, 0, min(16, $i)); }
    for($i = $len; $i > 0; $i >>= 1) { $text .= ($i & 1) ? chr(0) : $plainpasswd{0}; }
    $bin = pack("H32", md5($text));
    for($i = 0; $i < 1000; $i++)
    {
        $new = ($i & 1) ? $plainpasswd : $bin;
        if ($i % 3) $new .= $salt;
        if ($i % 7) $new .= $plainpasswd;
        $new .= ($i & 1) ? $bin : $plainpasswd;
        $bin = pack("H32", md5($new));
    }
    for ($i = 0; $i < 5; $i++)
    {
        $k = $i + 6;
        $j = $i + 12;
        if ($j == 16) $j = 5;
        $tmp = $bin[$i].$bin[$k].$bin[$j].$tmp;
    }
    $tmp = chr(0).chr(0).$bin[11].$tmp;
    $tmp = strtr(strrev(substr(base64_encode($tmp), 2)),
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/",
    "./0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz");
 
    return "$"."apr1"."$".$salt."$".$tmp;
}

if (!empty($_GET["pass"]) and !empty($_GET["user"])) {
 
	// Password to be used for the user
	 
	// Encrypt password
	$encrypted_password = crypt_apr1_md5($_GET["pass"], $_GET["salt"]);
	
echo "\t<b>Dati inseriti: </b><em>".$_GET["user"].", ".$_GET["pass"].((empty($_GET["salt"]))?"":(", ".$_GET["salt"]))."</em>\r\n<br><br>\r\n";
	echo "\t<b>Da inserire in <em>.htpass</em>: </b><input style=\"width:350px;text-align:center\" onclick=\"this.select();\" id=\"result\" type=\"text\" value=\"".$_GET["user"].":".$encrypted_password."\" /><input value=\"Copia\" type=\"button\" onclick=\"myFunction();\" />\r\n<br><br>\r\n";
	// Print line to be added to .htpasswd file
	?>
	
	<script>
		function myFunction() {
			
			var copyText = document.getElementById("result");

			/* Select the text field */
			copyText.select();
			copyText.setSelectionRange(0, 99999); /*For mobile devices*/

			/* Copy the text inside the text field */
			document.execCommand("copy");

			/* Alert the copied text */
			alert("Copied the text: " + copyText.value);
		}
	</script>
	
	<?php
	
}

 ?>
 
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
            <table>
                <tr>
                    <td><label for="user">Username:</label></td>
                    <td><label for="pass">Pass <em>(enc=apr1_md5)</em>:</label></td>
                    <td><label for="salt">Salt: <em>(optional)</em></label></td>
                    <td></td>
                </tr>
                <tr>
                    <td><input type="text" name="user" placeholder="*username"/></td>
                    <td><input type="text" name="pass" placeholder="*password"/></td>
                    <td><input type="text" name="salt" placeholder="salt_string=null"/></td>
                    <td><input type="submit" /></td>
                </tr>                
            </table>	
	</form>

        </div>
    </body>
</html>
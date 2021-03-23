<?php 

const PAGINE = array("index" => "Home",
                        "esame" => "Esami",
                        "chisiamo"=> "Chi Siamo",
                        "assistenza" => "Assistenza",
                        "profilo" => "Profilo"/*,
                        "login" => "Log in"*/);

$PAGINA_ATTUALE = htmlspecialchars($_SERVER['PHP_SELF']);

?>
		<!-- NAVBAR -->
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
			
                    <!-- -->
                    <div class="navbar-header">
                        <!-- pulsante menù della nav bar collassata -->
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>                        
                        </button>
                        
                        <a class="navbar-brand" href="#">Logo</a>
                    </div>

                    <!-- navbar effettiva -->
                    <div class="collapse navbar-collapse" id="myNavbar">

                        <!-- -->
                        <ul class="nav navbar-nav">
<?php 

foreach (PAGINE as $p => $n) {
    echo "\t\t\t\t\t\t\t"
    . '<li'. (( '/'.$p.'.php' === $PAGINA_ATTUALE ) ? ' class="active">' : '>' )
    . '<a href="'.$p.'.php">'.$n.'</a>'
    . "</li>\r\n";
}

?>
                        </ul>
						
                        <!-- -->
                        <ul class="nav navbar-nav navbar-right">
<?php	if (session_status() === PHP_SESSION_ACTIVE and !empty($_SESSION['TIME'])){ ?>
                            <li><a href="javascript:logout('<?php echo session_id(); ?>')"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li><!-- effettua il logout -->

                            <script>
                                function logout(sess_id) {
                                    let xhttp = new XMLHttpRequest();

                                    xhttp.onreadystatechange = function() {
                                        if (this.readyState == 4 && this.status == 200) {
                                            
                                            window.alert("Log out effettuato, Arrivederci!\r\nResponse: " + xhttp.responseText);
                                            window.location.replace('/index.php');

                                        } else if (this.readyState == 4 && this.status >= 300) {
                                            console.log(xhttp.responseText);
                                            return;
                                        } 
                                    };
                                    
                                    xhttp.open("get", "server.php?logout=" + sess_id);
                                    xhttp.send();
                                }
                            </script>
<?php  	}else{ ?>
                            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Login</a></li><!-- apre il modal login -->
<?php  	} ?>
                        </ul>
                        
                    </div>		
                </div>	
            </nav>
            <!-- FINE NAVBAR -->

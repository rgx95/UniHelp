<?php 

require_once("head.php"); 

?>
            
            <div id="intro" class="view"></div>
        </header>
        
        <style> header { height: 100% } </style>
        
        <!--------------------------------------------------------------------------------------

                                          CORPO DELLA PAGINA 

        ---------------------------------------------------------------------------------------->

        <script src="https://kit.fontawesome.com/9128ff7549.js" crossorigin="anonymous"></script>
        
        <h1 class="title">Login</h1>
            
        <div class="container marginetop">
            
            <div>
                
                <form id="login" name="login" class="form-group">
                   
                    <div class="login">
                        <label>Nome utente:</label><br>
                        <input name="user" type="text" class="form-control" placeholder="Username.." autofocus required <?php echo (SESSIONE::attiva())?'disabled':''; ?>> 
                    </div>

                    <div class="login">
                        <label>Password:</label><br>
                        <input name="pass" type="password" class="form-control" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required <?php echo (SESSIONE::attiva())?'disabled':''; ?>> 
                        <br><br>
                    </div>
                    
                    <span style="display:<?php echo (SESSIONE::attiva())?'inline':'none'; ?>">
                        Login gi&agrave; effettuato!
                    </span> 

                    <span id="err_userpass" class="login-err">
                        Nome utente e/o Password errati!
                    </span> 
                    
                    <div class="login" style="margin: 0 30% 0 30%; text-align: right; display:<?php echo (!SESSIONE::attiva())?'inline':'none'; ?>">
                        <label for="ricordami">Mantieni l'accesso</label>
                        <input type="checkbox" name="ricordami" checked="checked">                        
                    </div>
                    
                </form>
                
                <style>
                    form>span.login-err { width:80%; margin-top:1em; margin-left:auto; margin-right:auto; display:inline-block; display: none; }
                    form>div.login {text-align: left; margin-left: 30%;}
                </style>

                <script>
                    
                let loginForm = document.forms['login'];
                let user = document.forms['login'].elements[0];
                let pass = document.forms['login'].elements[1];
                let err_userpass = document.getElementById('err_userpass');
                
                user.addEventListener('input', function(){ richiesta_login() });
                pass.addEventListener('input', function(){ richiesta_login() });
                
                function valida_input() {
                    err_userpass.style.display = 'none';
                    
                    let patt = /^[a-z0-9]{8,16}$/i;
                    
                    if (!patt.test(user.value))
                        return false;
                    if (!patt.test(pass.value))
                        return false;
                    
                    return true;
                }
                
                function richiesta_login() {
                    // request verifica credenziali su server
                    let xhttp = new XMLHttpRequest();

                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            
                            let json = JSON.parse(xhttp.responseText);
                            
                            if (json.sess_id === undefined)
                               return;
                           
                            window.alert("Accesso effettuato");
                            
                            // procedo ad accedere alla sessione creata dal server
                            window.location.replace('/index.php');
                           
                        } else if (this.readyState == 4 && this.status >= 300) {
                            console.log(xhttp.responseText);
                            err_userpass.style.display = 'inline';
                            return;
                        } 
                    };
                    
                    // valida input
                    if (!valida_input())
                        return;

                    xhttp.open("GET", "server.php?user=" + user.value + "&pass=" + pass.value, false);
                    xhttp.send();
                }

                </script> 

            </div>		
        </div>
        
        <br><br><hr><br>
        
        
        <?php

include_once("footer.php"); 

?>

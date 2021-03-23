<?php require_once("head.php"); ?>

            <?php require_once("navbar.php"); ?>

            <!-- squarcio iniziale immagine di sfondo -->
            <div id="intro" class="view"></div>

        </header> 
        
        <style> header { height: 100%; } </style>
		
<?php //require("modal/import.php");  IMPORTO I MODAL DI BASE (login e profilo) ?>


            <!--------------------------------------------------------------------------------------

                                                                                    CORPO DELLA PAGINA 

            ---------------------------------------------------------------------------------------->

            <!-- TITOLO DELLA PAGINA -->

            <h1 class="title">uniHelp</h1>

            <!-- CONTENUTO PAGINA -->
            <div class="container marginetop">
                <div class="row">

                    <div class="col-sm-4">
                        <a href="#scroll" ><img  src="img/cerca.png" class="img-responsive shadow" style="width:30%; margin: auto;" alt="Image"></a>
                    </div>
                    <div class="col-sm-4"> 
                        <a href="#scroll" ><img src="img/leggi.png" class="img-responsive shadow" style="width:30%; margin: auto;" alt="Image"></a>
                    </div>
                    <div class="col-sm-4">
                        <a href="#scroll" ><img src="img/valuta.png" class="img-responsive shadow" style="width:30%; margin: auto;" alt="Image"></a>			
                    </div>

                </div>
            </div>

            <!-- squarcio immagine di sfondo -->
            <div class="marginetop">
                <div class="sfondoSfocato" class="view"></div>
            </div>

            <!-- inizio FORM di RICERCA -->
            <div class="container marginetop" >

                <!-- style suggerimenti -->
                <style>
                    /*<![CDATA[*/ 
                    div.tab { display: none; position: relative; padding: 0; margin:auto; max-width: 80% }
                    
                    div.suggerimenti_result { display:none; position: absolute; right: 20%; left: 20%; z-index: 99; max-height: 250px; overflow: auto; box-shadow: 0px 2px 5px 2px #cccccc; background: white; }
                    ul.suggerimenti_result { list-style: none; padding: 0; margin:0 }
                                        
                    ul.suggerimenti_result>li { padding:1em; }
                    ul.suggerimenti_result>hr{ padding:0; margin:0 }
                    
                    ul.suggerimenti_result:hover { cursor: pointer }
                    ul.suggerimenti_result>li:hover { background: #cccccc; color:white;}
                    
                    
                    /* Make circles that indicate the steps of the form: */
                    .step {
                      height: 15px;
                      width: 15px;
                      margin: 0 2px;
                      background-color: #bbbbbb;
                      border: none;
                      border-radius: 50%;
                      display: inline-block;
                      opacity: 0.5;
                    } /* Mark the active step: */
                    .step.active {
                      opacity: 1;
                    } /* Mark the steps that are finished and valid: */
                    .step.finish {
                      background-color: #4CAF50;
                    }
                    /*]]>*/
                </style>
                
                <!-- html form+suggerimenti step-by-step homemade -->
                <form class="form-group" method="get" action="esame.php" >
                    <input id="suggerimenti_uni_input_hidden" type="hidden" name="id_uni" >
                    <input id="suggerimenti_corso_input_hidden" type="hidden" name="id_corso" >
                    <input id="suggerimenti_esame_input_hidden" type="hidden" name="id_esame" >
                    
                    
                    <h3 style="text-align: left; margin: 0 auto 0 10%">Cerca:</h3>
                    <br>

                    <div class="tab" >
                        <div class="suggerimenti_input" class="input-group larghezza" >
                            <input id="suggerimenti_uni_input" class="form-control " placeholder="Cerca Universit&agrave;" required>
                        </div>
                        <div class="suggerimenti_result" >
                            <ul class="suggerimenti_result" id="suggerimenti_uni" >

                            </ul>
                        </div>
                    </div>

                    <div class="tab">
                        <div class="suggerimenti_input" class="input-group larghezza" >
                            <input id="suggerimenti_corso_input" class="form-control" placeholder="Cerca corso di laurea.."required>
                        </div>
                        <div class="suggerimenti_result">
                            <ul class="suggerimenti_result" id="suggerimenti_corso">

                            </ul>
                        </div>
                    </div>

                    <div class="tab">
                        <div class="suggerimenti_input" class="input-group larghezza" >
                            <input id="suggerimenti_esame_input" class="form-control " placeholder="Cerca esame.." required>
                        </div>
                        <div class="suggerimenti_result">
                            <ul class="suggerimenti_result" id="suggerimenti_esame">

                            </ul>
                        </div>
                    </div>
                    
                    <!-- Circles which indicates the steps of the form: -->
                    <div style="text-align:center;margin-top:40px;">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                    </div>

                    <br>

                    <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn  btn-success margineauto" href="#slideRicerca" role="button"  >Indietro</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn btn-success margineauto" href="#slideRicerca" role="button" >Avanti</button>


                </form>

                <!-- js form step-by-step homemade -->
                <script>
                var currentTab = 0; 
                showTab(currentTab); 

                function showTab(n) {

                  var x = document.getElementsByClassName("tab");
                  x[n].style.display = "block";

                  if (n == 0) {
                    document.getElementById("prevBtn").style.display = "none";
                  } else {
                    document.getElementById("prevBtn").style.display = "inline";
                  }

                  if (n == (x.length - 1)) {
                    document.getElementById("nextBtn").innerHTML = "Cerca";
                    document.getElementById("nextBtn").addEventListener('click', function(){
                        this.parentNode.submit();
                    });
                  } else {
                    document.getElementById("nextBtn").innerHTML = "Avanti";
                  }
                  
                  aggiornaStep(n);
                }
                
                function aggiornaStep(n) {
                  // This function removes the "active" class of all steps...
                  var i, x = document.getElementsByClassName("step");

                  for (i = 0; i < x.length; i++) {
                    x[i].className = x[i].className.replace(" active", "");
                  }

                  //... and adds the "active" class to the current step:
                  x[n].className += " active";
                }

                function nextPrev(n) {

                  var x = document.getElementsByClassName("tab");

                  x[currentTab].style.display = "none";

                  currentTab = currentTab + n;

                  showTab(currentTab);
                }
                </script>

                <!-- js suggerimenti homemade -->
                <script>

                mostra_nascondi(1);
                
                for ( let x of ['uni', 'corso', 'esame'] ) {
                  let obj = document.getElementById("suggerimenti_" + x + "_input");
                  obj.addEventListener("input", function(){ cerca(x, obj.value); });
                  obj.addEventListener("click", function(){ this.select(); });
                }

                function seleziona(parent, val, val_id) {
                    console.log(val);
                    let id = parent.getAttribute("id");
                    id += "_input";

                    let obj = document.getElementById(id);
                    obj.value = val;

                    document.getElementById(id + "_hidden").value = val_id;

                    mostra_nascondi(1);
                }

                function mostra_nascondi (val) {
                    let x = document.querySelectorAll("div.suggerimenti_result") //.style.display = "none";
                    let disp = 'none';

                    if (val === 0) {
                        disp = 'block';
                    } 

                    for (let i = 0; i < x.length; i++) {
                        x[i].style.display = disp;
                    }
                }

                function cerca(cerca, q) {                
                    if (cerca === ""){
                        console.log("param cerca empty");
                        return;
                    }

                    let xhttp = new XMLHttpRequest();

                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                           // Typical action to be performed when the document is ready:
                           let response = JSON.parse(xhttp.responseText);

                           let str = '\r\n';

                           for (let i = 0; i < response.length; i++) {
                                 str += '<li onclick="seleziona(this.parentElement, this.innerHTML, ' + response[i].id + ')" style="padding-left:0;">';  
                                 str += response[i].content;
                                 str += '</li>\r\n' + ((i == (response.length - 1)) ? '\r\n' : '<hr>\r\n');

                               document.getElementById('suggerimenti_' + cerca).innerHTML = str;
                           } 

                           mostra_nascondi(0);
                           // xhttp.responseText;
                        } else if (this.readyState == 4 && this.status >= 300) {
                            console.log(xhttp.responseText);
                            mostra_nascondi(1);
                        } 
                    };

                    let query = "cerca=" + cerca;
                    query += "&q=" + q;

                    xhttp.open("GET", "server.php?" + query, true);
                    xhttp.send();
                }

                </script>

            </div>
            <!-- fine FORM di RICERCA -->

            <!-- squarcio immagine di sfondo -->
            <div class="marginetop">
                <div class="sfondoSfocato view"></div>
            </div>

<?php include("footer.php"); ?>

        
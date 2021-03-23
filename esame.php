<?php require_once("head.php"); ?>

    <body>
		  
        <div class="height"> 
		
<?php //require_once("modal/import.php");  //IMPORTO I MODAL DI BASE (login e profilo) ?>		
			
            <!--------------------------------------------------------------------------------------

                                               CORPO DELLA PAGINA 

            ---------------------------------------------------------------------------------------->

            <div class="row sfondoSfocato sfondoSfocato2 marginetop" style="margin: 0" >
                <div class="col-sm-6 col-sm-offset-3" class="view" >
                    <h1 class="titleOther">Esame</h1>
                </div>
            </div>
            
            <div class="container marginetop">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-2" class="view">
                        <h1 class="subTitle"><span>Fisica 1</span> (<span>92494</span>)</h1>
                    </div>
                </div>
            </div>			

            <!-- CONTENUTO PAGINA -->
            <div class="container">

                <!-- BARRA DI NAVIGAZIONE TRA LE TAB -->
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 ">
                        
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tabInfo">Info</a></li>
                            <li><a data-toggle="tab" href="#tabRecensioni">Recensioni</a></li>
                            <li><a data-toggle="tab" href="#tabDomande">Domande</a></li>
                        </ul>
                        
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 ">
                        
                        <div class="tab-content" style="margin:0.8em; border-radius:4px; box-shadow: 10px 10px 30px #888888; background-color:#dee7fa;">

                            <!-- CONTENUTO TAB HOME -->
                            <div id="tabInfo" class="tab-pane fade in active" style="background-color:#dee7fa;"> 

                                <div class="row" style="padding-top:1em; padding-bottom:1em; background-color:#dee7fa;">
                                    <div class="col-sm-12">
                                        <h3 style="display:inline; text-align:left;">Crediti: <span style="font-weight:bold;">9 CFU</span></h3>
                                    </div>
                                </div>

                                <div class="row" style="padding-top:1em; padding-bottom:1em;background-color:#dee7fa; ">
                                    <div class="col-sm-12">
                                        <h3 style="display:inline; text-align:left;">Professore: <span style="font-weight:bold;">Gilberti</span></h3>				   
                                    </div> 
                                </div>  

                                <div class="row" style="padding-top:1em; padding-bottom:1em;background-color:#dee7fa; ">
                                    <div class="col-sm-12">
                                        <h3 style="display:inline; text-align:left;">Modalità: <span style="font-weight:bold;">Scritto e orale</span></h3>
                                    </div>
                                </div> 
                                
                                <div class="row" style="padding-top:1em; padding-bottom:1em; background-color:#dee7fa;">
                                    <div class="col-sm-12">
                                        <h3 style="display:inline; text-align:left;">Difficoltà: <meter max=1.0 min=0.0 value=0.06 high=.75 low=.4 optimum=0.1></meter>
                                        <span style="font-weight:bold;">Si può fare</span></h3>
                                    </div>
                                </div>


    <?php //if(isset($_SESSION['user_data']['user'])) { ?>
                                <div class="row" style="padding-top:1em; padding-bottom:1em;background-color:#bdc6d8; ">
                                    <div class="col-sm-12">
                                        <h3 style="display:inline; text-align:center; font-weight:bold; border:">
                                            <a href="#" class="" data-toggle="modal" data-target="#modalRecensione">INSERISCI UNA RECENSIONE</a>
                                        </h3>
                                    </div>
                                </div>
    <?php //} ?>
                            </div>
                            <!-- FINE TAB HOME -->

                            <!-- CONTENUTO TAB RECENSIONI -->							
                            <div id="tabRecensioni" class="tab-pane fade">
                                <div class="review container"> 
                                    <div class="row" style="margin-top:0.5em;" >
                                        
                                        <div class="col-sm-6">
                                            <h4 style="display:inline">Utente: </h4>
                                            <p style="display:inline">Semino</p>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <h4 style="display:inline">Difficoltà: </h4>
                                        </div>

                                    </div>
                                    
                                    <div class="row" style="margin-top:1.5em;" >
                                        <h4 style="display:block">Comportamento del professore: </h4>
                                        <p style="display:inline;text-align: justify;text-justify: auto;">bla bla bla</p>
                                    </div>
                                    
                                    <div class="row" style="margin-top:1.5em;" >
                                        <h4 style="display:block">Commenti: </h4>
                                        <p style="display:inline; text-align: justify;text-justify: auto;">Carolo è uno stronzo! Fa schifo in tutto! Vai, vai al 
                                            tuo acquaparkino e restaci! Scemo! testo troppo lungoooooooooooooooooooooooooo ooooooooooooooooooooo 
                                            le le ooooooooooooooooooooo oooooooooooooooooooooooooooooooooooooooooooo    oooooooooooooooooooooooooooooooooooooooooooo
                                            ooooooooooooooooooooooooooooooooooooyes</p>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- FINE TAB RECENSIONI-->

                            <!-- CONTENUTO TAB DOMANDE -->
                            <div id="tabDomande" class="tab-pane fade">
                                <div class="questions container"> 
                                    <div class="row question">  
                                        
                                        <div style="text-align:left;" class="col-xs-9">
                                            <p class="domande2"> aaaa aksjdlj asj lj alj lkj lkjfkjfkjkdjkdj fkj fkdjf iejfiejfij fk kf jkjfkjfejeieifjiej jf   fkjekfjkejfkjsoiejf  jfjsdfdf </p> 
                                        </div>
                                        
                                        <div style="text-align:right;" class="col-xs-3">
                                            <p style="display:inline;">Voti: <span >2</span> </p> <span style="position:relative; "class="closeDomande" data-ng-click="AUMENTO VOTI DOMANDA">+</span>
                                        </div>

                                    </div> 
                                    
                                    <div class="row question">  
                                        
                                        <div style="text-align:left;" class="col-xs-9">
                                            <p class="domande2"> Quanto è pazzo Carolo? </p> 
                                        </div>
                                        
                                        <div style="text-align:right;" class="col-xs-3">
                                            <p style="display:inline;">Voti: <span >7</span> </p> <span style="position:relative; "class="closeDomande" data-ng-click="AUMENTO VOTI DOMANDA">+</span>
                                        </div>	
                                        
                                    </div> 
                                    
                                </div>
                            </div>	
                            <!-- FINE TAB DOMANDE -->
                            
                        </div>
                    </div>
                </div>
            </div>	
		
<?php include_once("footer.php"); ?>

            
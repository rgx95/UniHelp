
			<!-- MODAL DI AGGIUNTA NUOVA RECENSIONE -->
			<div id="modalRecensione" class="modal fade" role="dialog">
				<div class="modal-dialog modalRecensione" >
					<div class="modal-content">
						
						<!-- HEADER DEL MODAL -->
						<div class="modal-header" style="background-color:#112739;">
							<button type="button" class="close" data-dismiss="modal" style="opacity:0.8;color: white; font-size: 22pt; text-shadow: none;">&nbsp;&times;&nbsp;</button>
							<h4 class="modal-title">Recensisci l'esame</h4>
						</div>
					   
						<!-- CONTENITORE FASI NUOVA RECENSIONE -->
						<div class="modal-body">
							<div id="myCarousel" class="carousel slide" style="height:74%" data-interval="false" data-ride="carousel">	
								<div class="carousel-inner" style="height:100%;overflow-y: scroll;" role="listbox">
									
									<!-- DOMANDE -->																
									<div class="item active" id="avviaAppDomande" data-ng-app="appDomande" data-ng-controller="controllerDomande">
									
										<h3>Elenca alcune domande che ti sono state fatte:</h3><br>
										
										<div class="container">
											<div ng-show="erroreDomande !== ''" class="alert alert-warning">
												<strong>Attenzione: </strong>{{ erroreDomande }}
											</div>
										</div>
										
										<div class="container">	
											<form class="form-group">
												<div class="input-group">
													<input id="domandaDaAggiungere" type="text" data-ng-keypress="tastoInvioDomanda($event)" ng-model="domandaDaAggiungere" class="form-control input-lg" placeholder="Inserisci una domanda..." autofocus>
													<span class="input-group-addon btn btn-info" ng-click="aggiungiDomanda()">&nbsp;+&nbsp;</span>
												</div>
											</form>
										</div>
										
										<div class="container">
											<div class="alert alert-info alert-dismissible" ng-repeat="x in listaDomande">
												<a href="#" class="close" ng-click="eliminaDomande($index)" data-dismiss="alert" aria-label="close">&times;</a>
												{{ x }}
											</div>
										</div>
										
										<div class="container">
											<ul class="pager">
												<li><button class="btn btn-default" href="#myCarousel" role="button" data-slide="prev" disabled>Indietro</button></li>
												<li><button class="btn btn-{{(listaDomande.length <= 0) ? 'default' : 'success'}}" href="#myCarousel" role="button" ng-disabled="listaDomande.length <= 0" data-slide="next" onclick="cambiaFlag(0,1)">Avanti</button></li>
											</ul>
										</div>
										
									</div>		
									<script src="modal/script/appDomande.js"></script>								
									<!-- FINE SLIDE DOMANDE -->
									
								  
									<!-- RECENSIONE PROFF -->
									<div class="item">
										<form name="recensioneForm" id="recensioneForm" ng-app="recensioneApp" ng-controller="recensioneCtrl" nonvalidate>
										
											<div class="container">
												<h3>Qual è stato l'atteggiamento del proff? </h3>
											</div>
											
											<br><br>
											
											<div class="container">
												<div ng-show="recensioneForm.recensioneTesto.$invalid && recensioneForm.recensioneTesto.$touched" class="alert alert-warning">
													<strong>Attenzione: </strong>Dai su, scrivi almeno 30 caratteri!
												</div>
											</div>
											
											<div class="container form-group">
												<textarea autofocus class="form-control" style="width:100%;" required name="recensioneTesto" ng-model="recensioneTesto" rows="10" required ng-minlength="30" maxlength="1400" placeholder="Il professore è si mostrato molto disponibile e paziente..."></textarea>
											</div>
											
											<div class="container">
												<ul class="pager">
													<li><button class="btn btn-info" href="#myCarousel" role="button" data-slide="prev" onclick="cambiaFlag(1,0);cambiaFlag(0,0)">Indietro</button></li>
													<li><button class="btn btn-{{(recensioneForm.recensioneTesto.$invalid) ? 'default' : 'success'}}" href="#myCarousel" role="button" ng-disabled="recensioneForm.recensioneTesto.$invalid" data-slide="next" onclick="cambiaFlag(1,1)">Avanti</button></li>
												</ul>
											</div>
										</form>	
										
										<script>
											var recensioneApp = angular.module('recensioneApp', []);
											recensioneApp.controller('recensioneCtrl', function($scope) {});
											
											angular.bootstrap(document.getElementById("recensioneForm"), ['recensioneApp']);
										</script>
										
										
									</div>
									<!-- FINE RECENSIONE PROFF -->
									
									<!-- DIFFICOLTA' E COMMENTO -->
									<div class="item">
										<form name="commentoForm" id="commentoForm" ng-app="commentoApp" ng-controller="commentoCtrl" nonvalidate>
											
											<div class="container">
												<h3>Valuta la difficoltà dell'esame:</h3>
												
												<div class="row">
													<div class="col-md-2">
													</div>
													<div class="col-md-8 col-xs-12">
														<div class="slidecontainer">
															<input type="range" min="1" max="5" value="3" step="1" class="slider" id="myRange">
														</div>
													</div>
													<div class="col-md-2">
													</div>
												</div>
												
												<div class="row hidden-xs hidden-sm">
													<div class="col-md-1">
													</div>
													<div class="col-md-2 text-right">
														Passeggiata
													</div>
													<div class="col-md-2 text-center">
														Facile
													</div>
													<div class="col-md-2 text-center">
														Normale
													</div>
													<div class="col-md-2 text-left">
														Impegnativo
													</div>
													<div class="col-md-2 text-left">
														Impossibile
													</div>
													<div class="col-md-1">
													</div>
												</div>
												
												<br>
												
												<h3>Commento complessivo sull'esame?</h3>
												
											</div>
											
											<div class="container">
												<div ng-show="commentoForm.commentoTesto.$invalid && commentoForm.commentoTesto.$touched" class="alert alert-warning">
													<strong>Attenzione: </strong>Dai su, scrivi almeno 30 caratteri!
												</div>
											</div>
											
											<div class="container form-group">
												<textarea required name="commentoTesto" ng-model="commentoTesto" ng-minlength="30" maxlength="1400" style="width:100%" class="form-control" rows="10" placeholder="L'orale ha richiesto molto ragionamento, ma è stato rapido..."></textarea>
											</div>
											
											<div class="container">
												<ul class="pager">
													<li><button class="btn btn-info" href="#myCarousel" role="button" data-slide="prev" onclick="cambiaFlag(2,0); cambiaFlag(1,0)">Indietro</button></li>
													<li><button class="btn btn-{{(commentoForm.commentoTesto.$invalid) ? 'default' : 'success'}}" href="#myCarousel" role="button" ng-disabled="commentoForm.commentoTesto.$invalid" onclick="cambiaFlag(2,1)">Conferma</button></li>
												</ul>
											</div>
										</form>
										<script>
											var commentoApp = angular.module('commentoApp', []);
											commentoApp.controller('commentoCtrl', function($scope) {});
											
											angular.bootstrap(document.getElementById("commentoForm"), ['commentoApp']);
										</script>
										
									</div>
									<!-- FINE DIFFICOLTA E COMMENTO -->
									
								</div>
							</div>
						</div>
						<!-- FINE CONTENITORE FASI NUOVA RECENSIONE -->
						
						<!-- FOOTER DEL MODAL -->
						<div class="modal-footer">
							
							<!-- BARRA DI PROGRESSO AGGIUNTA RECENSIONE -->
							<div class="container-fluid">
								<div class="progress">
									<div id="progressBar" class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
										<span id="progressBarText"></span>
									</div>
								</div>
							</div>
							
							<div class="container-fluid">
								<button id="inviaRecensione" class="btn btn-block btn-success" data-dismiss="modal" disabled>Invia!</button> <!-- quando le 3 sezioni sono fatte la classe diventa btn-success per farlo divenire verde -->
							</div>
						</div>
						
						<script>
							
							var checkFasiRecensione = [0,0,0];
							
							var progressValue = 0;
								
							$("#inviaRecensione").click(function(e){
								window.confirm("Stai per inviarci la tua recensione...\nSei sicuro di voler continuare?");
								window.alert("Recensione inviata!");
								checkFasiRecensione = [0,0,0];
								
								cambiaFlag();
								
								$("#inviaRecensione").prop("disabled", true);
								$("#modalRecensione").modal("hide");
								$("#progressBarText").html("");		
								$('#myCarousel').carousel(0);		
							});	
							
							function cambiaFlag(n,v) {	
								if (n === undefined)
									n = 0;
								if (v === undefined)
									v = 0;
								
								checkFasiRecensione[n] = v;
								
								if (checkFasiRecensione[0] && checkFasiRecensione[1] && checkFasiRecensione[2])
									$("#inviaRecensione").prop("disabled", false);
								else 
									$("#inviaRecensione").prop("disabled", true);
								
								var flagsSum = checkFasiRecensione[0] + checkFasiRecensione[1] + checkFasiRecensione[2];
							
								if (flagsSum === 0)
									$("#progressBarText").html("");
								else
									$("#progressBarText").html(flagsSum + "/3 Completato");
								
								$("#progressBar").attr("aria-valuenow", Math.floor(33.34 * flagsSum));
								$("#progressBar").css("width",  Math.floor(33.34 * flagsSum) + "%");
								
								// aggiungo/modifico l'etichetta della barra solo dopo la fine della transizione css qui sopra
								/*$("#progressBar").one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',   
								function(e) {			
									if (flagsSum === 0)
										$("#progressBarText").html("");
									else
										$("#progressBarText").html(flagsSum + "/3 Completato");
								});	*/		
								
							}
							
						</script>
						
					</div>										
				</div>
			</div>
			<!-- FINE MODAL DI AGGIUNTA NUOVA RECENSIONE -->

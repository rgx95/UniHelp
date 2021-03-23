
			<!-- MODAL PROFILO -->
			<div id="modalProfilo" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">					
<?php if (isset($_SESSION['user_data'])){ ?>
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"> <?php echo $_SESSION['user_data']['user']; ?> </h4>
						</div>
						
						<div class="row">
							<div class="col-sm-4">
							
								<!-- DATI UTENTE -->
								<div style="text-align:left;" class="modal-body">
<?php
	
		$dati_utente = $_SESSION['user_data']; // array dei dati utente
		array_splice($dati_utente, array_search('user', array_keys($dati_utente)), 1); // cerco l'indice dell'elemento user così da poterl'elemento user dalla lista
								
		foreach ($dati_utente as $i => $v) {								
			echo "<p class=\"modaltext\">" . ucfirst($i) . ": <span class=\"modalspan\"> " . $v . " </span> </p>"; // scrivo una riga (ucfirst() rende maiuscola la prima lettera di una stringa)
		} ?>																			
								</div>	
								
							</div>
							
							<div class="col-sm-8">
							
								<!-- AVATAR UTENTE -->
								<img src="<?php echo "img/usr/" . $_SESSION['user_data']['user'] . ".jfif"; ?>" class="img-responsive" style="width:80%; margin-left: auto; margin-right: auto;" alt="Avatar">
								
							</div>
					   
						</div>
<?php 	} else { ?>						
						<!-- LOGIN NON EFFETTUATO -->
<?php 	} ?>						   
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
						</div>
					</div>
				</div>
			</div>
			<!-- FINE MODAL PROFILO -->
			
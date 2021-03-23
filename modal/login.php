
			<!-- MODAL LOGIN -->
			<div id="modalLogin" class="modal fade" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Log-in</h4>
						</div>
						
						<div id="avviaAppLogin" ng-app="appLogin" ng-controller="controllerLogin">
							<form name="login" ng-submit="submitLogin()">
								<div class="row" style="text-align: center;">
									<div class="col-sm-8 login" style="float:none;">
										<label>Nome utente:</label><br>
										<input name="user" type="text" ng-model="user" class="form-control" placeholder="username" autofocus required> 
									</div>
								</div>
								<div class="row" style="text-align: center;">
									<div class="col-sm-8 login" style="float:none;">
										<label>Password:</label><br>
										<input name="pass" type="password" ng-model="pass" class="form-control" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required> 
									</div>
								</div>
								
								<span style="width:80%; margin-top:1em; margin-left:auto; margin-right:auto; display:inline-block; color:red" ng-show="login.user.$touched && login.user.$invalid || login.pass.$touched && login.pass.$invalid">
									I campi non possono essere vuoti!
								</span>
								
								<br>
								
								<span style="width:80%; margin-top:1em; margin-left:auto; margin-right:auto; display:inline-block;" ng-show="loginFailed0">
									Nome utente e/o Password errati!
								</span>
								
								<span style="width:80%; margin-top:1em; margin-left:auto; margin-right:auto; display:inline-block;" ng-show="loginFailed1">
									Impossibile raggiungere il server!
								</span>
								
								<div class="row" style="text-align: center;">
									<div class="col-sm-8 login" style="float:none; margin-bottom:1em;">
										<label for="ricordami">Mantieni l'accesso</label>
										<input name="ricordami" type="checkbox" ng-model="ricordami">
										<br>
										<input type="submit" class="btn btn-success" value="Accedi">
									</div>
								</div>
							</form>
						</div>		

												
							
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
						</div>
					</div>
				</div>
			</div>
			<!-- FINE MODAL LOGIN --> 
			
			<!-- INIZIO MODAL LOGIN AVVENUTO -->
			<div id="modalLoginAvvenuto" class="modal fade" role="dialog" >
				<div class="modal-dialog">
					<div class="modal-content">	
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"></h4>
						</div>
						
						<div class="row" style="text-align: center;">
							<h4>Login avvenuto con successo</h4>
						</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
						</div>
					</div>
				</div>
			</div>
			<!-- FINE MODAL LOGIN AVVENUTO --> 
			
			
			<!-- SCRIPT LOGIN -->
			<script src="modal/script/appLogin.js"></script>
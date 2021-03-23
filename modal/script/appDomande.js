/**************** INIZIO APPLICATIVO appDomande *****************/

var appDomande = angular.module("appDomande", []);

appDomande.controller("controllerDomande", function($scope,$http) { // controller dell'applicazione domande
	$scope.listaDomande = []; // array contenente le domande
	//$scope.listaDomandeConfermate = []; // array di domande confermate
	$scope.erroreDomande = ""; // errore mostrato nello span 
	
	$scope.aggiungiDomanda = function () {//definisco func dell'ng-app che gestisce l'aggiunta delle domande 
		if (!$scope.domandaDaAggiungere) { // controllo che il testo della domandaDaAggiungere non sia vuoto					
			$scope.erroreDomande = "Campo vuoto!"; // riempo lo span con un messaggio di errore ed esco dalla func
			return;
		}
		
		//if (($scope.listaDomande.indexOf($scope.domandaDaAggiungere) < 0) && ($scope.listaDomandeConfermate.indexOf($scope.domandaDaAggiungere) < 0)) { // verifico se esiste già la stessa domanda
		if ($scope.listaDomande.indexOf($scope.domandaDaAggiungere) < 0) { // verifico se esiste già la stessa domanda
			$scope.listaDomande.push($scope.domandaDaAggiungere); // inserisco il testo della domanda nell'array
			$scope.erroreDomande = ""; // resetto testo di errore	
			
			// resetto campo e valore bindato
			$("#domandaDaAggiungere").val("");
			$scope.domandaDaAggiungere = "";
			
		} else {
			$scope.erroreDomande = "Domanda gia' inserita!"; // ritorno errore 'duplicato' ed esco (finisce la funzione)
		}
	};
	
	$scope.tastoInvioDomanda = function(event){
		if (event.which == "13") {
			$scope.erroreDomande = "";
			$scope.aggiungiDomanda();
		} return 0;
	};
	
	$scope.eliminaDomande = function (numeroDomanda){ // definisco func che elimina una domanda già inserita
		$scope.listaDomande.splice(numeroDomanda,1); // taglio fuori dall'array 1 solo elemento (la domanda da elidere)	
		$scope.erroreDomande = ""; // resetto testo di errore
	};
	
	
	/* $scope.salvaDomande = function () {
		if ($scope.listaDomande.length==0) {
			$scope.erroreDomande = "Non hai ancora inserito nuove domande!";
			return;
		}
		
		$scope.listaDomandeConfermate = $scope.listaDomandeConfermate.concat($scope.listaDomande);
		$scope.listaDomande = [];
		
	}; */
});

angular.bootstrap(document.getElementById("avviaAppDomande"), ['appDomande']);

/**************** FINE APPLICATIVO appDomande ******************/
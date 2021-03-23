/**************** INIZIO APPLICATIVO appLogin *****************/

var appLogin = angular.module("appLogin", []);
							
appLogin.controller("controllerLogin", function ($scope, $http) {
	$scope.ricordami = false;
	
	$scope.submitLogin = function () {					
		var data_obj = {q: 0, user: $scope.user, pass: $scope.pass, ricordami: $scope.ricordami};
		var json_data_obj = JSON.stringify(data_obj);
		
		$scope.loginFailed0 = false;
		$scope.loginFailed1 = false;
		
		$http.get("../unihelp/php/request.php?q=" + json_data_obj)
		.then(function(response) {
			if (response.data==0) {
				$scope.loginFailed0 = true;
				return;
			}
			
			/* chiudo il #modalLogin e mostro #modalLoginAvvenuto */
			$("#modalLogin").modal("hide");
			$("#modalLoginAvvenuto").modal("show");
			
			/* aggiungo un event listener in jquery che controlla la chiusura del 
			#modalLoginAvvenuto e attende la transizione css per ricaricare la pagina */
			$('#modalLoginAvvenuto').on('hidden.bs.modal', function () {
				window.location.assign("?s="+response.data);
			})										
			
		}, function(response) {
			$scope.loginFailed1 = true;
		});
	};
});

/**************** FINE APPLICATIVO appLogin ******************/

angular.bootstrap(document.getElementById("avviaAppLogin"), ['appLogin']);
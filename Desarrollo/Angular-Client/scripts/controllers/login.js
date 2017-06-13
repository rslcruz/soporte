'use strict'; 

angular.module('Client')
	.controller('LoginCtrl', function($rootScope, $scope, $auth, $location,$localStorage,$sessionStorage) {
		if ($auth.isAuthenticated() ) {
	        $location.path('/inicio');
	    }
		$scope.title = "Acceso de Usuario"; 
		$scope.button = "Ingresar";
		$scope.Usuario = {};

		$rootScope.login = function() {	
			$auth.login($scope.Usuario).then(
				function(response){
					//$rootScope.UsuarioLogueado = response.data.usuario;
					$sessionStorage.$default({UsuarioLogueado:response.data.usuario});
					$rootScope.UsuarioLogueado = $sessionStorage.UsuarioLogueado;
					Materialize.toast('Bienvenido.', 3000, 'green accent-4');
					$location.path('/inicio');
				},
				function(error){
					if(error.data == null){
						Materialize.toast('Servicio Web caído',3000,'red accent-4');
					}else{
						Materialize.toast((error.data.error == 'invalid_credentials') ? 'Usuario y/o Contraseña incorrectos' : 'No hay conexión', 1000, 'red accent-4');
						$location.path('/inicio');
					}
				}
			)
		};
		
	});

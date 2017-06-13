'use strict';

angular.module('Client')
	.controller('IndexUsuarioCtrl', function($scope, UsuarioResource, $location, $timeout) {
		$scope.Usuarios = UsuarioResource.query();
		$scope.removeUsuario = function(id) {
			UsuarioResource.delete({
				id: id
			});
			Materialize.toast('Usuario Eliminado.', 3000, 'green accent-4');
			$timeout(function() {
				$location.path('/usuarios');
			}, 1000);
		};
	})
	.controller('CreateUsuarioCtrl', function($scope, UsuarioResource,PerfilResource, $location, $timeout) {
		$scope.title = "Agregar Usuario"; 
		$scope.button = "Guardar";
		$scope.Usuario = {};
		$scope.Usuario.puesto="";
		$scope.Usuario.perfil_id="";
		$scope.Usuario.activo=1;
		$scope.perfiles =  PerfilResource.query();
		$scope.saveUsuario = function() {
			if(validateFormUsuario($scope)){
				UsuarioResource.save($scope.Usuario);
				Materialize.toast('Usuario Creado.', 3000, 'green accent-4');
				$timeout(function() {
					$location.path('/usuarios');
				}, 1000);
			}
		};
	})
	.controller('EditUsuarioCtrl', function($scope, UsuarioResource, $location, $timeout, $routeParams) {
		$scope.title = "Editar Usuario";
		$scope.button = "Actualizar";
		$scope.Usuario = UsuarioResource.get({
			id: $routeParams.id
		});
		$scope.saveUsuario = function() {
			UsuarioResource.update($scope.Usuario);
			Materialize.toast('Usuario Actualizado.', 3000, 'green accent-4');
			$timeout(function() {
				$location.path('/usuarios');
			}, 1000);
		};
	})
	.controller('mainController', function($scope) {
	  $scope.sortType     = 'nombre'; // set the default sort type
	  $scope.sortReverse  = false;  // set the default sort order
	  $scope.search   = '';     // set the default search/filter term
	 
	});

function validateFormUsuario($scope){
	if($scope.Usuario.puesto === ""){
		Materialize.toast('Debes seleccionar un puesto.', 3000, 'red accent-4');
		return false;
	}
	if($scope.Usuario.perfil_id === ""){
		Materialize.toast('Debes seleccionar un perfil.', 3000, 'red accent-4');
		return false;
	}
	if($scope.Usuario.password !== $scope.Usuario.confirmar_password){
		Materialize.toast('La contraseñas no coinciden.', 3000, 'red accent-4');
		return false;
	}
	return true;
}
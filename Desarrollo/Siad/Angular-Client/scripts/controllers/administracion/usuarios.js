'use strict';

angular.module('Client')
	.controller('UsuarioCtrl', function($scope, UsuarioResource,PerfilResource,EmpresaResource, $location, $timeout) {
		$scope.includeCargado = function(){
			angular.forEach(angular.element('#nav-menu-administracion li'),function(value,key){
				angular.element(value).removeClass('active');
			});
			angular.element( document.querySelector( '#usuarios' )).addClass('active');
		};

		$scope.sortType = 'activo'; // set the default sort type
	  	$scope.sortReverse  = true;  // set the default sort order
	  	$scope.search   = '';     // set the default search/filter term
		$scope.usuarios = UsuarioResource.query();
		$scope.Usuario = {};
		$scope.perfiles =  PerfilResource.query();
		$scope.empresas = EmpresaResource.query();
		$scope.estados = [{value:1, name:"Activo"},{value:0,name:"Baja"}];


		$scope.$on('ngRepeatEmpresaFinished', function(ngRepeatEmpresaFinished) {
			$("#selectEmpresa").selectpicker('refresh');
		});

		$scope.$on('ngRepeatEmpresaEditarFinished', function(ngRepeatEmpresaEditarFinished) {
			$("#selectEmpresaEditar").selectpicker('refresh');
		});

		$scope.$on('ngRepeatPerfilFinished', function(ngRepeatPerfilFinished) {
			$("#selectPerfil").selectpicker('refresh');
		});

		$scope.$on('ngRepeatPerfilEditarFinished', function(ngRepeatPerfilEditarFinished) {
			$("#selectPerfilEditar").selectpicker('refresh');
		});

		$scope.$on('ngRepeatPerfilEditarFinished', function(ngRepeatPerfilEditarFinished) {
			$("#selectPerfilEditar").selectpicker('refresh');
		});

		$scope.agregarUsuario = function() {
			if(validateFormUsuario($scope) && comprobarUsuario($scope)){
				$scope.Usuario.activo=1;
				console.log($scope.Usuario);
				UsuarioResource.save($scope.Usuario).$promise.then(
					function(value){
						Materialize.toast('Usuario creado.', 3000, 'green accent-4');
						$scope.usuarios = UsuarioResource.query();
						$('#myModalCrearUsuario').modal('hide');
					},
					function(error){
						Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
					}
				);
			}
		};

		$scope.modalEditarUsuario = function(id_usuario){
			$scope.UsuarioEditado = UsuarioResource.get({
				id_usuario: id_usuario
			});
			$scope.ckbCambiarContrasena=false;
			$scope.UsuarioEditado.$promise.then(function(response){
				$timeout(function() {
		            $("#selectEmpresaEditar").selectpicker('refresh');
		            $("#selectPerfilEditar").selectpicker('refresh');
		            $("#selectEstadoEditar").selectpicker('refresh');
		  		});
			});	
		};

		$scope.editarUsuario = function(){
			if(validateFormEditarUsuario($scope)){
				$scope.UsuarioEditado.contrasenaNueva=$scope.ckbCambiarContrasena;
				UsuarioResource.update($scope.UsuarioEditado).$promise.then(
					function(value){
						Materialize.toast('Usuario editado.', 3000, 'green accent-4');
						$scope.usuarios = UsuarioResource.query();
						$('#myModalEditarUsuario').modal('hide');
					},
					function(error){
						Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
					}
				);
			}
		}

		$scope.limpiarFormUsuario = function(){
			$scope.Usuario={};
			$scope.perfiles =  PerfilResource.query();
			$scope.empresas = EmpresaResource.query();
		}
	});

function validateFormUsuario($scope){
	if($scope.Usuario.empresa_id==null){
		Materialize.toast('Debes seleccionar una empresa.', 3000, 'red accent-4');
		$('#selectEmpresa').selectpicker('toggle');
		return false;
	}
	if($scope.Usuario.perfil_id == null){
		Materialize.toast('Debes seleccionar un perfil.', 3000, 'red accent-4');
		$('#selectPerfil').selectpicker('toggle');
		return false;
	}
	if($scope.Usuario.password !== $scope.Usuario.confirmar_password){
		Materialize.toast('La contraseñas no coinciden.', 3000, 'red accent-4');
		return false;
	}
	return true;
}

function validateFormEditarUsuario($scope){
	if($scope.ckbCambiarContrasena && $scope.UsuarioEditado.password !== $scope.UsuarioEditado.confirmar_password){
		Materialize.toast('La contraseñas no coinciden.', 3000, 'red accent-4');
		return false;
	}
	return true;
}

function comprobarUsuario($scope){
	for (var i = 0; i < $scope.usuarios.length; i++) {
		if($scope.usuarios[i].nombre_usuario.toLowerCase()===$scope.Usuario.nombre_usuario.toLowerCase()){
			Materialize.toast('Ese usuario ya existe.', 3000, 'red accent-4');
			return false;
		}
	}
	return true;
}
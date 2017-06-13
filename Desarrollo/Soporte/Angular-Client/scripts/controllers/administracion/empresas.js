'use strict';

angular.module('Client')
	.controller('EmpresaCtrl', function($scope,EmpresaResource, $location, $timeout) {
		$scope.includeCargado = function(){
			angular.forEach(angular.element('#nav-menu-administracion li'),function(value,key){
				angular.element(value).removeClass('active');
			});
			angular.element( document.querySelector( '#empresas' )).addClass('active');
		};

		$scope.sortType = 'empresa'; // set the default sort type
	  	$scope.sortReverse  = true;  // set the default sort order
		$scope.empresas = EmpresaResource.query(); 
		$scope.Empresa={};


		$scope.agregarEmpresa = function(){
			if(comprobarEmpresa($scope,$scope.Empresa.empresa)){
				EmpresaResource.save($scope.Empresa).$promise.then(
					function(value){
						Materialize.toast('Empresa creada.', 3000, 'green accent-4');
						$scope.empresas = EmpresaResource.query();
						$('#myModalCrearEmpresa').modal('hide');
					},
					function(error){
						Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
					}
				);
			}
		};

		$scope.modalEditarEmpresa = function(id_empresa){
			$scope.EmpresaEditada = EmpresaResource.get({
				id_empresa: id_empresa
			});
		};

		$scope.editarEmpresa = function(){
			if(comprobarEmpresa($scope,$scope.EmpresaEditada.empresa)){
				EmpresaResource.update($scope.EmpresaEditada).$promise.then(
					function(value){
						Materialize.toast('Empresa editada.', 3000, 'green accent-4');
						$scope.empresas = EmpresaResource.query();
						$('#myModalEditarEmpresa').modal('hide');
					},
					function(error){
						Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
					}
				);
			}
		};

		$scope.limpiarFormEmpresa = function(){
			$scope.Empresa={};
		};

		$scope.modalEliminarEmpresa = function(id,empresa){
			$scope.elementoEliminar = empresa;
			$scope.id_eliminar_empresa_temporal = id;
		};

		$scope.eliminarEmpresa = function(){
			EmpresaResource.delete({id_empresa: $scope.id_eliminar_empresa_temporal}).$promise.then(
					function(value){
						if(value.mensaje==='borrada'){
							$scope.empresas = EmpresaResource.query();
							Materialize.toast('Empresa eliminada.', 3000, 'green accent-4');
						}else{
							Materialize.toast('No se puede eliminar.', 3000, 'red accent-4');
						}
					},
					function(error){
						Materialize.toast('No se puede eliminar.', 3000, 'red accent-4');
					}
				);
			$('#myModalEliminarEmpresa').modal('hide');
		};
	});

	function comprobarEmpresa($scope,palabra){
		for (var i = 0; i < $scope.empresas.length; i++) {
			if($scope.empresas[i].empresa.toLowerCase()===palabra.toLowerCase()){
				Materialize.toast('Esa empresa ya existe.', 3000, 'red accent-4');
				return false;
			}
		}
		return true;
	}


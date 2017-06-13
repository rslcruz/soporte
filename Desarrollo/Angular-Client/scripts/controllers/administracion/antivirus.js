'use strict';

angular.module('Client')
	.controller('AntivirusCtrl', function($scope,AntivirusResource, $location, $timeout) {
		$scope.includeCargado = function(){
			angular.forEach(angular.element('#nav-menu-administracion li'),function(value,key){
				angular.element(value).removeClass('active');
			});
			angular.element( document.querySelector( '#antivirus' )).addClass('active');
		};

		$scope.sortType = 'antivirus'; // set the default sort type
	  	$scope.sortReverse  = false;  // set the default sort order
		$scope.antivirus = AntivirusResource.query(); 
		$scope.Antivirus={};


		$scope.agregarAntivirus = function(){
			if(comprobarAntivirus($scope,$scope.Antivirus.antivirus)){
				AntivirusResource.save($scope.Antivirus).$promise.then(
					function(value){
						Materialize.toast('Antivirus creado.', 3000, 'green accent-4');
						$scope.antivirus = AntivirusResource.query();
						$('#myModalCrearAntivirus').modal('hide');
					},
					function(error){
						Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
					}
				);
			}
		};

		$scope.modalEditarAntivirus = function(id_antivirus){
			$scope.AntivirusEditado = AntivirusResource.get({
				id_antivirus: id_antivirus
			});
		};

		$scope.editarAntivirus = function(){
			if(comprobarAntivirus($scope,$scope.AntivirusEditado.antivirus)){
				AntivirusResource.update($scope.AntivirusEditado).$promise.then(
					function(value){
						Materialize.toast('Antivirus editada.', 3000, 'green accent-4');
						$scope.antivirus = AntivirusResource.query();
						$('#myModalEditarAntivirus').modal('hide');
					},
					function(error){
						Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
					}
				);
			}
		};

		$scope.limpiarFormAntivirus = function(){
			$scope.Antivirus={};
		};

		$scope.modalEliminarAntivirus = function(id,antivirus){
			$scope.elementoEliminar = antivirus;
			$scope.id_eliminar_antivirus_temporal = id;
		};

		$scope.eliminarAntivirus = function(){
			AntivirusResource.delete({id_antivirus: $scope.id_eliminar_antivirus_temporal}).$promise.then(
					function(value){
						if(value.mensaje==='borrado'){
							$scope.antivirus = AntivirusResource.query();
							Materialize.toast('Antivirus eliminado.', 3000, 'green accent-4');
						}else{
							Materialize.toast('No se puede eliminar.', 3000, 'red accent-4');
						}
					},
					function(error){
						Materialize.toast('No se puede eliminar.', 3000, 'red accent-4');
					}
				);
			$('#myModalEliminarAntivirus').modal('hide');
		};
	});

	function comprobarAntivirus($scope,palabra){
		for (var i = 0; i < $scope.antivirus.length; i++) {
			if($scope.antivirus[i].antivirus.toLowerCase()===palabra.toLowerCase()){
				Materialize.toast('Ese antivirus ya existe.', 3000, 'red accent-4');
				return false;
			}
		}
		return true;
	}


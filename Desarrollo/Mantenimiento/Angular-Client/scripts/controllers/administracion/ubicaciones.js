'use strict';

angular.module('Client')
	.controller('UbicacionCtrl', function($scope,UbicacionResource, $location, $timeout) {
		$scope.includeCargado = function(){
			angular.forEach(angular.element('#nav-menu-administracion li'),function(value,key){
				angular.element(value).removeClass('active');
			});
			angular.element( document.querySelector( '#ubicaciones' )).addClass('active');
		};

		$scope.sortType = 'edificio';
	 	$scope.sortReverse  = false; 
		$scope.ubicaciones = UbicacionResource.query(); 
		$scope.Ubicacion = {};
		$scope.Ubicacion.edificio=1;
		$scope.Ubicacion.piso="PB";

		$scope.edificios = [
			{value:1,name:"1"},{value:2,name:"2"},{value:3,name:"3"},{value:4,name:"4"},{value:5,name:"5"},
			{value:6,name:"6"},{value:7,name:"7"},{value:8,name:"8"},{value:9,name:"9"},{value:10,name:"10"},
			{value:11,name:"11"},{value:12,name:"12"},{value:13,name:"13"},{value:14,name:"14"},{value:15,name:"15"},
			{value:16,name:"16"},{value:17,name:"17"},{value:18,name:"18"},{value:19,name:"19"},{value:20,name:"20"},
		];
		$scope.pisos = [
			{value:"PB", name:"PB"},
			{value:"P1", name:"P1"},
			{value:"P2", name:"P2"},
			{value:"P3", name:"P3"},
			{value:"P4", name:"P4"},
		];

		$timeout(function() {
			$("#selectEdificio").selectpicker('refresh');
			$("#selectPiso").selectpicker('refresh');
		 });


		$scope.agregarUbicacion = function(){
			if(comprobarUbicacion($scope.ubicaciones,$scope.Ubicacion)){
				UbicacionResource.save($scope.Ubicacion).$promise.then(
					function(value){
						Materialize.toast('Ubicacion creada.', 3000, 'green accent-4');
						$scope.ubicaciones = UbicacionResource.query();
						$('#myModalCrearUbicacion').modal('hide');
					},
					function(error){
						Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
					}
				);
			}
		};



		$scope.modalEliminarUbicacion = function(ubicacion){
			$scope.elementoEliminar = "Edificio "+ubicacion.edificio+" Piso "+ubicacion.piso;
			$scope.id_eliminar_ubicacion_temporal = ubicacion.id_ubicacion;
		};

		$scope.eliminarUbicacion = function(){
			UbicacionResource.delete({id_ubicacion: $scope.id_eliminar_ubicacion_temporal}).$promise.then(
					function(value){
						if(value.mensaje==='borrada'){
							$scope.ubicaciones = UbicacionResource.query();
							Materialize.toast('Ubicacion eliminada.', 3000, 'green accent-4');
						}else{
							Materialize.toast('No se puede eliminar.', 3000, 'red accent-4');
						}
					},
					function(error){
						Materialize.toast('No se puede eliminar.', 3000, 'red accent-4');
					}
				);
			$('#myModalEliminarUbicacion').modal('hide');
		};

		$scope.limpiarFormUbicacion = function(){
			$scope.Ubicacion.edificio=1;
			$scope.Ubicacion.piso="PB";
			$timeout(function() {
				$("#selectEdificio").selectpicker('refresh');
				$("#selectPiso").selectpicker('refresh');
			 });
		};
	});

	function comprobarUbicacion(array,ubicacion){
		for (var i = 0; i < array.length; i++) {
			if(array[i].edificio==ubicacion.edificio && array[i].piso === ubicacion.piso){
				Materialize.toast('Esa ubicacion ya existe.', 3000, 'red accent-4');
				return false;
			}
		}
		return true;
	}
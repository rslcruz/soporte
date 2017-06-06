'use strict';

angular.module('Client')
.controller('EditarAsignadaCtrl',  function($scope,$rootScope, $location, $timeout,$routeParams,$window,SolicitudResource,InventarioResource,ServicioResource,TecnicoResource){
	$scope.includeCargado = function(){
		angular.forEach(angular.element('#nav-menu-soporte li'),function(value,key){
			angular.element(value).removeClass('active');
		});
		angular.element(document.querySelector( '#solicitudesLi')).addClass('active');
	};
	$scope.asignada=true;
	$scope.asignadai=false;
	$scope.asignadar=false;
	$scope.agregarObservacion="";
	$scope.Solicitud = SolicitudResource.get({
		id_solicitud_soporte: $routeParams.id_solicitud_soporte
	});

	$scope.Solicitud.$promise.then(function(response) {
		$scope.Solicitud.fecha_atencion= new Date();
		if($scope.Solicitud.estatus_solicitud_id!=1){
			console.log($scope.Solicitud);
			Materialize.toast('No puedes realizar esa acción.', 3000, 'red accent-4');
			$location.path('/soporte/solicitudes');
		}
	});

	$scope.Solicitud.fecha_atencion= new Date();

	$scope.dateFormat = function(date){
		return moment(date).format('DD/MM/YYYY - h:mm a'); 
	};

 $scope.$watch('Solicitud.fecha_atencion', function(valorNuevo, valorViejo) {
 $scope.Solicitud.fecha_atencion= moment(valorNuevo).format('YYYY/MM/DD  H:mm:ss ');  

	
    });

	$scope.options = [{
		name: 'Incidencia',
		value: 'Incidencia'
	}, {
		name: 'Servicio nuevo',
		value: 'Servicio nuevo'
	}];

	$scope.optionsEstatus = [{
		name: 'En proceso',
		value: 2
	},{
		name: 'Enviado a laboratorio',
		value: 3
	},{
		name: 'En tramite de garantia',
		value: 4
	},{
		name: 'Cancelado',
		value: 10
	}];
 

$scope.divsol= function(){
		$scope.asignada=true;
		$scope.asignadai=false;
		$scope.asignadar=false;
	};

    $scope.divinv= function(){
		$scope.asignadai=true;
		$scope.asignada=false;
		$scope.asignadar=false;
	};

    $scope.divresg= function(){
    	$scope.asignadar=true;
		$scope.asignadai=false;
		$scope.asignada=false;
	};

	 $scope.divtodo= function(){
    	$scope.asignada=true;
		$scope.asignadai=true;
		$scope.asignadar=true;
	};





	$scope.editarAsignada = function() {
		if(validarFecha($scope)){
			$scope.Solicitud.tipo_atencion = $scope.tipoAtencion.value;
			$scope.Solicitud.estatus_solicitud_id  = $scope.estatus.value;
			if ($scope.agregarObservacion!="") {
				$scope.Solicitud.observaciones +=" "+$scope.agregarObservacion;
			};
			SolicitudResource.update($scope.Solicitud);
			Materialize.toast('Solicitud modificada.', 3000, 'green accent-4');
			$timeout(function() {
				$location.path('/soporte/solicitudes');
			}, 1000);
		}
	};
});

function validarFecha($scope){
	
	if(!moment($scope.Solicitud.fecha_atencion).isAfter($scope.Solicitud.fecha_apertura)){
		Materialize.toast('La fecha de atención debe ser después de la fecha de apertura.', 4000, 'red accent-4');
		return false;
	}
	return true;
}
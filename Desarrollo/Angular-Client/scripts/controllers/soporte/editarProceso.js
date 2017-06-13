'use strict';

angular.module('Client')
.controller('EditarProcesoCtrl',  function($scope,$rootScope, $location, $timeout,$routeParams,$window,SolicitudResource,InventarioResource,ServicioResource,TecnicoResource,TipoReparacionResource,ClasificacionReparacionResource,SubclasificacionReparacionResource,NivelServicioResource){
	$scope.includeCargado = function(){
		angular.forEach(angular.element('#nav-menu-soporte li'),function(value,key){
			angular.element(value).removeClass('active');
		});
		angular.element(document.querySelector( '#solicitudesLi')).addClass('active');
	};


	$scope.editarproceso=true;
  	$scope.inventario=false;
  	

	$scope.Solicitud = SolicitudResource.get({
		id_solicitud_soporte: $routeParams.id
	});


	$scope.TipoReparacion = TipoReparacionResource.query();
	//$scope.Reparacion='';
	$scope.Select2=true;
	$scope.Select3=true;
    $scope.Clasificaciones = ClasificacionReparacionResource.query();  
    //$scope.Solicitud.fecha_reparacion= new Date(); 
  
$scope.dateFormat = function(date){
		return moment(date).format('DD/MM/YYYY - h:mm a'); 
	};

	$scope.dateFormat2 = function(date){
		return moment(date).format('YYYY/MM/DD  H:mm:ss '); 
	};

 $scope.$watch('Reparacion', function(valorNuevo, valorViejo) {
    
      console.log(valorNuevo);
        // Prevenir que se ejecute si es undefined los valores
        if( valorNuevo === undefined ){
                return;
        }    
        else if(valorNuevo ===""){
        	$scope.Select2=true;
        	$scope.Clasificacion = ClasificacionReparacionResource.get({id_clasificacion_reparacion:0});
        	$scope.CReparacion="";
        }

        // En este momento puedes saber cuando cambia el valor del modelo
       else{
       $scope.CReparacion="";
       $scope.Clasificacion = ClasificacionReparacionResource.get({id_clasificacion_reparacion:valorNuevo});
       $scope.Select2=false;
      }
    });

 

 $scope.$watch('CReparacion', function(valorNuevo, valorViejo) {
    
      console.log(valorNuevo);
        // Prevenir que se ejecute si es undefined los valores
        if( valorNuevo === undefined ){
                return;
        }    
        else if(valorNuevo ===""){
        	$scope.Select3=true;
        	$scope.Subreparacion= SubclasificacionReparacionResource.get({id_subclasificacion_reparacion:0})
        	$scope.SReparacion="";
        }

        // En este momento puedes saber cuando cambia el valor del modelo
       else{
      $scope.SReparacion="";
      $scope.Select3=false;
      $scope.Subreparacion= SubclasificacionReparacionResource.get({id_subclasificacion_reparacion:valorNuevo}); 
       
      }
    });

$scope.$watch('Solicitud.fecha_reparacion', function(valorNuevo, valorViejo) {
 $scope.Solicitud.fecha_reparacion= moment(valorNuevo).format('YYYY/MM/DD  H:mm:ss ');  

	
    });

$scope.optionsEstatus = [{
		name: 'Pend. por concluir',
		value: 8
	},{
		name: 'Pend. por cotización',
		value: 5
	},{
		name: 'Cancelado',
		value: 10
	}];

 $scope.Nservicio = NivelServicioResource.query();   

	 $scope.agregarObservacion="";
	
	$scope.divsol= function(){
		$scope.editarproceso=true;
		$scope.inventario=false;
		$scope.resguardante=false;
	};

    $scope.divinv= function(){
		$scope.inventario=true;
		$scope.editarproceso=false;
		$scope.resguardante=false;
	};

    $scope.divresg= function(){
    	$scope.resguardante=true;
		$scope.editarproceso=false;
		$scope.inventario=false;
	};

	 $scope.divtodo= function(){
    	$scope.resguardante=true;
		$scope.editarproceso=true;
		$scope.inventario=true;
	};






	$scope.Solicitud.$promise.then(function(response) {
		$scope.Solicitud.fecha_reparacion = new Date();
		if($scope.Solicitud.estatus_solicitud_id!=2){
			Materialize.toast('No puedes realizar esa acción.', 3000, 'red accent-4');
			$location.path('/soporte/solicitudes');
		}
	});

	
		

	$scope.editarProceso = function() {
		console.log($scope.Solicitud);
		if(validarFecha($scope)){
		$scope.Solicitud.estatus_solicitud_id  = $scope.estatus.value;
		$scope.Solicitud.subclasificacion_reparacion_id = $scope.SReparacion;
		$scope.Solicitud.nivel_servicio_id = $scope.NivelServicio;
			
			// if ($scope.agregarObservacion!="") {
			// 	$scope.Solicitud.observaciones +=" "+$scope.agregarObservacion;
			// }; 



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
		Materialize.toast('La fecha de atención debe ser después de la fecha de apertura.', 2000, 'red accent-4');
		return false;
	}
	return true;
}
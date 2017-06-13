'use strict'; 

angular.module('Client')
.controller('NuevaSolicitudCtrl',  function($scope,$rootScope, $location, $timeout,$window,SolicitudResource,InventarioResource,ServicioResource,TecnicoResource,TecnicoTurnoResource){
	$scope.includeCargado = function(){
		angular.forEach(angular.element('#nav-menu-soporte li'),function(value,key){
			angular.element(value).removeClass('active');
		});
		angular.element(document.querySelector('#nuevasolicitudLi')).addClass('active');
	};

	$scope.informacionAdicional = false;

	//FORMULARIO PARA EL CODIGO DE BARRAS
	 $scope.inventario = '00001';
	$scope.vistaNuevaSolicitud = 'solicitaInventario';
	$scope.comprobarInventario = function () {
		$scope.InventarioResult = InventarioResource.get({id: $scope.inventario});
		$scope.InventarioResult.$promise.then(function(response){
			if(response.id_inventario != null){
				$scope.vistaNuevaSolicitud = 'inventarioAceptado';
			}else{
				Materialize.toast('El número de inventario no existe.', 3000, 'red accent-4');
				$scope.inventario='';
			}
		});
	};

	//FORMULARIO PARA LA SOLICITUD
	$scope.title ='Nueva solicitud para inventario: ';
	$scope.button = 'Guardar';
	$scope.buttonMessage = 'Ver bien instrumental';
	//obtener servicios solicitados
	$scope.servicios = ServicioResource.query();
	//obtener tecnicos
	//$scope.tecnicos = TecnicoResource.query();
    $scope.tecnicos = TecnicoTurnoResource.query();	

    
	$scope.tecnicos.$promise.then(function(response){
		if(response){
			 $scope.Tecnico =  $scope.tecnicos[0].id_usuario;			  

		}else{
			console.log("Error! no hay tecnicos");
		}
	});

  //FUNCION PARA GUARDAR
	$scope.Solicitud = {};
	$scope.Solicitud.estatus_solicitud_id = 1;
	$scope.Solicitud.usuario_id = $rootScope.UsuarioLogueado.id_usuario;
	$scope.Solicitud.servicio_solicitado_id = '';
	$scope.Solicitud.observaciones = '';
	$scope.Solicitud.usuario_atendido='';
	

	$scope.guardarSolicitud = function() {
		$scope.Solicitud.tecnico_id = $scope.Tecnico;
		$scope.Solicitud.inventario_id = $scope.InventarioResult.id_inventario;
		if(validateForm($scope)){
			SolicitudResource.save($scope.Solicitud);
			Materialize.toast('Solicitud Creada.', 3000, 'green accent-4');
			$timeout(function() {
				$location.path('/soporte/solicitudes');
			}, 1000);
		}

	};

	$scope.verInformacion = function(){
		$scope.informacionAdicional = !$scope.informacionAdicional;
		$scope.buttonMessage = (!$scope.informacionAdicional) ?  'Ver bien instrumental' :  'Ocultar bien instrumental';
	};


});

function validateForm($scope){
	if($scope.Solicitud.servicio_solicitado_id === ""){
		Materialize.toast('Debes seleccionar un servicio.', 3000, 'red accent-4');
		return false;
	}
	return true;
}


'use strict';
angular.module('Client')
.controller('VerInventarioCtrl',  function($scope, $location,$route, $timeout,$window,InventarioResource,$routeParams,
	ClasificacionesTipoEquipoResource,TiposEquipoResource,MarcasEquipoResource,ModelosEquipoResource,
	ResguardantesResource,UsuarioEquipoResource,AntivirusResource,MarcaSistemaOperativoResource,
	SistemaOperativoResource,VersionSistemaOperativoResource,ComputadoraResource,SwitchResource){
	$scope.includeCargado = function(){
		angular.forEach(angular.element('#nav-menu-inventario li'),function(value,key){
			angular.element(value).removeClass('active');
		});
		angular.element( document.querySelector( '#listaInventarioLi' )).addClass('active');
	};

	$scope.clasificacionesTipoEquipo = ClasificacionesTipoEquipoResource.query();
	$scope.usuarios = UsuarioEquipoResource.query();
	$scope.subareas = ResguardantesResource.query();
	$scope.antivirus = AntivirusResource.query();
	$scope.marcasSO = MarcaSistemaOperativoResource.query();
	$scope.switches = SwitchResource.query();

	$scope.cargandoInventario=true;
	$scope.vistaEditable=false;
	$scope.ckbModeloNuevo=false;
	$scope.ckbResguardanteNuevo=false;
	$scope.ckbSONuevo=false;
	$scope.usuarioEquipo=false;
	$scope.computadora=false;
	$scope.redcableada=false;
	

	InventarioResource.get({
		id: $routeParams.id
	}).$promise.then(
		function(value){
			if(value.id_inventario!=null){
				$scope.Inventario = value;
				$scope.InventarioCopia = angular.copy($scope.Inventario);
				if($scope.Inventario.encargado!=null){
					$scope.usuarioEquipo=true;
				}
				if($scope.Inventario.computadora!=null){
					$scope.computadora=true;
					if($scope.Inventario.computadora.red_cableada!=null){
						$scope.redcableada=true;
						$timeout(function() {
							$('#selectSwitchEditar').attr('disabled',true);
				            $("#selectSwitchEditar").selectpicker('refresh');
				  		},2000);
					}
					$timeout(function() {
						$('#selectAntivirusEditar').attr('disabled',true);
			            $("#selectAntivirusEditar").selectpicker('refresh');
			  		},2000);
				}
				$scope.cargandoInventario=false;	
			}else{
				Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
				$timeout(function() {
					$location.path('/inventario/listaInventario');
				}, 1000);
			}
		},
		function( error ){
			Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
			$timeout(function() {
				$location.path('/inventario/listaInventario');
			}, 1000);
		}
	);


	$scope.modificarInventario = function(){
		if(validateFormModificarInventario($scope)){
			if($scope.ckbModeloNuevo){
				$scope.Inventario.modelo_equipo_id = $scope.modelo_equipo_id;
			}
			if($scope.ckbResguardanteNuevo){
				$scope.Inventario.resguardante_id = $scope.resguardante_id;
			}
			if($scope.ckbUsuarioNuevo){
				$scope.Inventario.encargado_id = $scope.encargado_id;
			}
			if($scope.ckbSONuevo){
				$scope.Inventario.computadora.sistema_operativo_version_id=$scope.sistema_operativo_version_id;
			}
			if($scope.computadora){
				ComputadoraResource.update($scope.Inventario.computadora).$promise.then(
					function(value){
					},
					function(error){
						Materialize.toast('No se pudo modificar la computadora.', 3000, 'red accent-4');
					}
				);
			}
			InventarioResource.update({id:$scope.Inventario.id_inventario},$scope.Inventario).$promise.then(
				function(value){
					if(value.mensaje === 'modificado'){
						Materialize.toast('Inventario modificado.', 3000, 'green accent-4');
						$route.reload();
					}else{
						Materialize.toast('No se pudo modificar.', 3000, 'red accent-4');
					}
				},
				function(error){
					Materialize.toast('No se pudo modificar.', 3000, 'red accent-4');
				}
			);
		}
	};

	$scope.cancelarEditar = function(){
		$scope.Inventario = angular.copy($scope.InventarioCopia);
		$scope.vistaEditable=false;
		$timeout(function() {
			$('#selectAntivirusEditar').attr('disabled',true);
			$("#selectAntivirusEditar").selectpicker('refresh');
			$('#selectSwitchEditar').attr('disabled',true);
			$("#selectSwitchEditar").selectpicker('refresh');
		});
	}

	$scope.vistaEditar = function(){
		$scope.vistaEditable=true;
		$('#selectAntivirusEditar').attr('disabled',false);
		$("#selectAntivirusEditar").selectpicker('refresh');
		$('#selectSwitchEditar').attr('disabled',false);
		$("#selectSwitchEditar").selectpicker('refresh');
	}

	$scope.tiposEquipo = [{
		"id_tipo_equipo":0,
		"tipo_equipo":"prueba",
		"clasificacion_tipo_equipo_id":0
	}];

	$scope.marcasEquipo = [{
		"id_marca_equipo": 0,
		"marca_equipo": "prueba"
	}];

	$scope.modelosEquipo = [{
		"id_modelo_equipo": 0,
		"modelo_equipo": "prueba"
	}];

	$scope.sistemasOperativos = [{
		"id_sistema_operativo":0,
		"sistema_operativo":"prueba",
		"marca_sistema_operativo_id":"prueba"
	}]; 

	$scope.versionesSO = [{
		"id_version_sistema_operativo":0,
		"version_sistema_operativo":"prueba",
		"sistema_operativo_id":"prueba"
	}]; 

	$('#selectSO').attr('disabled',true);
	$('#selectVersion').attr('disabled',true);
	$('#selectTipo').attr('disabled',true);
	$('#selectMarca').attr('disabled',true);
	$('#selectModelo').attr('disabled',true);
	

	$scope.$on('ngRepeatResguardanteFinished', function(ngRepeatResguardanteFinished) {
		$("#selectResguardante").selectpicker('refresh');
	});

	$scope.$on('ngRepeatUsuarioFinished', function(ngRepeatUsuarioFinished) {
		$("#selectUsuario").selectpicker('refresh');
	});

	$scope.$on('ngRepeatClasificacionFinished', function(ngRepeatClasificacionFinished) {
		$("#selectClasificacion").selectpicker('refresh');
	});

	$scope.$on('ngRepeatTipoFinished', function(ngRepeatTipoFinished) {
		$("#selectTipo").selectpicker('refresh');
	});

	$scope.$on('ngRepeatMarcaFinished', function(ngRepeatMarcaFinished) {
		$("#selectMarca").selectpicker('refresh');
	});

	$scope.$on('ngRepeatModeloFinished', function(ngRepeatModeloFinished) {
		$("#selectModelo").selectpicker('refresh');
	});

	$scope.$on('ngRepeatMarcasSOFinished', function(ngRepeatMarcasSOFinished) {
		$("#selectMarcaSO").selectpicker('refresh');
	});

	$scope.$on('ngRepeatSOFinished', function(ngRepeatUsuarioFinished) {
		$("#selectSO").selectpicker('refresh');
	});

	$scope.$on('ngRepeatVersionFinished', function(ngRepeatUsuarioFinished) {
		$("#selectVersion").selectpicker('refresh');
	});

	$scope.clasificacionCambiada = function(){
		$scope.tiposEquipo = TiposEquipoResource.query({
			id: $scope.id_clasificacion_tipo_equipo
		});
		$scope.tiposEquipo.$promise.then(function(data) {
			if($scope.tiposEquipo.length>0){
				$('#selectTipo').attr('disabled',false);
			}else{
				$('#selectTipo').attr('disabled',true);
				$('#selectTipo').selectpicker('refresh');
			}
		});
		
	}
	$scope.tipoCambiado = function(){
		$scope.marcasEquipo = MarcasEquipoResource.query({
			id: $scope.id_tipo_equipo
		});
		$scope.marcasEquipo.$promise.then(function(data) {
			if($scope.marcasEquipo.length>0){
				$('#selectMarca').attr('disabled',false);
			}else{
				$('#selectMarca').attr('disabled',true);
				$('#selectMarca').selectpicker('refresh');
			}
		});
		$('#selectClasificacion').attr('disabled',true);
		$('#selectClasificacion').selectpicker('refresh');
	}

	$scope.marcaCambiada = function(){
		$scope.modelosEquipo = ModelosEquipoResource.query({
			idTipo:$scope.id_tipo_equipo,
			idMarca: $scope.id_marca_equipo
		});
		$scope.modelosEquipo.$promise.then(function(data) {
			if($scope.modelosEquipo.length>0){
				$('#selectModelo').attr('disabled',false);
			}else{
				$('#selectModelo').attr('disabled',true);
				$('#selectModelo').selectpicker('refresh');
			}
		});
		$('#selectTipo').attr('disabled',true);
		$('#selectTipo').selectpicker('refresh');
	}

	$scope.modeloCambiado = function(){
		$('#selectMarca').attr('disabled',true);
		$('#selectMarca').selectpicker('refresh');
	}

	$scope.marcaSOCambiada = function(){
		$scope.sistemasOperativos = SistemaOperativoResource.query({
			id_sistema_operativo: $scope.id_marca_sistema_operativo
		});
		$scope.sistemasOperativos.$promise.then(function(data) {
			if($scope.sistemasOperativos.length>0){
				$('#selectSO').attr('disabled',false);
			}else{
				$('#selectSO').attr('disabled',true);
				$('#selectSO').selectpicker('refresh');
			}
		});
	}
	$scope.SOCambiado = function(){
		$scope.versionesSO = VersionSistemaOperativoResource.query({
			id_sistema_operativo: $scope.id_sistema_operativo
		});
		$scope.versionesSO.$promise.then(function(data) {
			if($scope.versionesSO.length>0){
				$('#selectVersion').attr('disabled',false);
			}else{
				$('#selectVersion').attr('disabled',true);
				$('#selectVersion').selectpicker('refresh');
			}
		});
		$('#selectMarcaSO').attr('disabled',true);
		$('#selectMarcaSO').selectpicker('refresh');
	}


	$scope.versionCambiada = function(){
		$('#selectSO').attr('disabled',true);
		$('#selectSO').selectpicker('refresh');
	}
});

function validateFormModificarInventario($scope){

	if($scope.ckbModeloNuevo){
		if($scope.id_clasificacion_tipo_equipo==null){
			Materialize.toast('Debes seleccionar una clasificación.', 3000, 'red accent-4');
			$('#selectClasificacion').selectpicker('toggle');
			return false;
		}else if($scope.id_tipo_equipo==null){
			Materialize.toast('Debes seleccionar un tipo.', 3000, 'red accent-4');
			$('#selectTipo').selectpicker('toggle');
			return false;
		}else if($scope.id_marca_equipo==null){
			Materialize.toast('Debes seleccionar una marca.', 3000, 'red accent-4');
			$('#selectMarca').selectpicker('toggle');
			return false;
		}else if($scope.modelo_equipo_id==null){
			Materialize.toast('Debes seleccionar un modelo.', 3000, 'red accent-4');
			$('#selectModelo').selectpicker('toggle');
			return false;
		}
	}
	if($scope.ckbResguardanteNuevo){
		if($scope.resguardante_id == null){
			Materialize.toast('Debes seleccionar un resguardante.', 3000, 'red accent-4');
			$('#selectResguardante').selectpicker('toggle');
			return false;
		}
	}
	if($scope.ckbUsuarioNuevo){
		if($scope.encargado_id == null){
			Materialize.toast('Debes seleccionar un usuario.', 3000, 'red accent-4');
			$('#selectUsuario').selectpicker('toggle');
			return false;
		}
	}
	if($scope.ckbSONuevo){
		if($scope.id_marca_sistema_operativo==null){
			Materialize.toast('Debes seleccionar una marca de S.O.', 3000, 'red accent-4');
			$('#selectMarcaSO').selectpicker('toggle');
			return false;
		}else if($scope.id_sistema_operativo==null){
			Materialize.toast('Debes seleccionar un Sistema Operativo.', 3000, 'red accent-4');
			$('#selectSO').selectpicker('toggle');
			return false;
		}else if($scope.sistema_operativo_version_id==null){
			Materialize.toast('Debes seleccionar una versión de S.O.', 3000, 'red accent-4');
			$('#selectVersion').selectpicker('toggle');
			return false;
		}
	}
	return true;
}
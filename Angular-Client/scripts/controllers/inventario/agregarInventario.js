'use strict';

angular.module('Client')
.controller('AgregarInventarioCtrl',  function($scope, $location, $timeout,$window,
	InventarioResource,ResguardantesResource,ClasificacionesTipoEquipoResource,TiposEquipoResource,
	MarcasEquipoResource,ModelosEquipoResource,UsuarioEquipoResource,SistemaOperativoResource,
	AntivirusResource,ComputadoraResource,UbicacionResource,MarcaSistemaOperativoResource,
	VersionSistemaOperativoResource,SwitchResource){
	$scope.includeCargado = function(){
		angular.forEach(angular.element('#nav-menu-inventario li'),function(value,key){
			angular.element(value).removeClass('active');
		});
		angular.element( document.querySelector( '#agregarLi' )).addClass('active');
	};

	$scope.clasificacionesTipoEquipo = ClasificacionesTipoEquipoResource.query();
	$scope.marcasSO = MarcaSistemaOperativoResource.query();
	$scope.ubicaciones = UbicacionResource.query();
	$scope.subareas = ResguardantesResource.query();
	$scope.usuarios = UsuarioEquipoResource.query();
	$scope.antivirus = AntivirusResource.query();

	$scope.switches =[{
		"id_switch": 0,
		"ip": 0,
		"mask": 0,
		"inventario": {
			"ubicacion": {
				"id_ubicacion": 0,
				"edificio": 0,
				"piso": 0
			}
		}
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

	// $scope.sistemasOperativos = SistemaOperativoResource.query();
	
	$scope.Inventario={};
	$scope.UsuarioNuevo={};
	$scope.Computadora={};
	$scope.Computadora.ingreso_a_dominio=1;
	$scope.Computadora.ocs_inventory=1;
	$scope.Switch={};
	$scope.Computadora.RedCableada={};
	$scope.ckbEquipoRed=false;
	$scope.ckbRedCableada=false;
	$scope.Inventario.responsiva_firmada=false;

	$('#selectTipo').attr('disabled',true);
	$('#selectMarca').attr('disabled',true);
	$('#selectModelo').attr('disabled',true);
	$('#selectSwitch').attr('disabled',true);
	$('#selectSO').attr('disabled',true);
	$('#selectVersion').attr('disabled',true);


	$scope.$on('ngRepeatResguardanteFinished', function(ngRepeatResguardanteFinished) {
		$("#selectResguardante").selectpicker('refresh');
	});

	$scope.$on('ngRepeatUsuarioFinished', function(ngRepeatUsuarioFinished) {
		$("#selectUsuario").selectpicker('refresh');
	});

	$scope.$on('ngRepeatSubareaFinished', function(ngRepeatUsuarioFinished) {
		$("#selectSubarea").selectpicker('refresh');
	});

	$scope.$on('ngRepeatAntivirusFinished', function(ngRepeatUsuarioFinished) {
		$("#selectAntivirus").selectpicker('refresh');
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

	$scope.$on('ngRepeatUbicacionFinished', function(ngRepeatUbicacionFinished) {
		$("#selectUbicacion").selectpicker('refresh');
	});

	$scope.$on('ngRepeatUbicacionInventarioFinished', function(ngRepeatUbicacionInventarioFinished) {
		$("#selectUbicacionInventario").selectpicker('refresh');
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

	$scope.$on('ngRepeatSwitchFinished', function(ngRepeatSwitchFinished) {
		$("#selectSwitch").selectpicker('refresh');
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
	
	$scope.agregarInventario = function () {
		$scope.InventarioResult = InventarioResource.get({id: $scope.Inventario.id_inventario});
		$scope.InventarioResult.$promise.then(function(response){
			if(response.id_inventario == null){
				if(validateFormInventario($scope)){					
					if(!$scope.ckbUsuario && !$scope.ckbUsuarioNuevo){
						$scope.Inventario.encargado_id=null;
					}
					$scope.Inventario.modelo_equipo_id = $scope.id_modelo_equipo;
					$scope.Inventario.activo=1;

					if($scope.ckbUsuarioNuevo){
						UsuarioEquipoResource.save($scope.UsuarioNuevo).$promise.then(
							function( value ){
								if(value.id_usuario_equipo!=null){
									$scope.Inventario.encargado_id=value.id_usuario_equipo;
									if($scope.ckbEquipoRed){
										ComputadoraResource.save($scope.Computadora).$promise.then(
											function( value ){
												if(value.id_computadora!=null){
													$scope.Inventario.computadora_id=value.id_computadora;
													InventarioResource.save($scope.Inventario).$promise.then(
														function(value){
															Materialize.toast('Inventario agregado.', 3000, 'green accent-4');
														},
														function(error){
															Materialize.toast('Error al agregar Inventario.', 3000, 'green accent-4');
														}
														);
												}else{
													Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
												}
											},
											function( error ){
												Materialize.toast('Ocurrió un error al insertar nueva computadora.', 3000, 'red accent-4');
											}
											);
									}else{
										if($scope.ckbSwitch){
											SwitchResource.save($scope.Switch).$promise.then(
												function(value){
													if(value.id_switch!=null){
														$scope.Inventario.switch_id=value.id_switch;
														InventarioResource.save($scope.Inventario).$promise.then(
															function(value){
																Materialize.toast('Inventario agregado.', 3000, 'green accent-4');
															},
															function(error){
																Materialize.toast('Error al agregar Inventario.', 3000, 'green accent-4');
															}
															);
													}else{
														Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
													}
												},
												function(error){
													Materialize.toast('Ocurrió un error al insertar switch.', 3000, 'red accent-4');
												}
												);
										}else{
											InventarioResource.save($scope.Inventario).$promise.then(
												function(value){
													Materialize.toast('Inventario agregado.', 3000, 'green accent-4');
												},
												function(error){
													Materialize.toast('Error al agregar Inventario.', 3000, 'green accent-4');
												}
												);
										}
									}
								}else{
									Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
								}
							},
							function( error ){
								Materialize.toast('Ocurrió un error al insertar nuevo usuario.', 3000, 'red accent-4');
							}
							);
}else{
	if($scope.ckbEquipoRed){
		ComputadoraResource.save($scope.Computadora).$promise.then(
			function(value){
				if(value.id_computadora!=null){
					$scope.Inventario.computadora_id=value.id_computadora;
					InventarioResource.save($scope.Inventario).$promise.then(
						function(value){
							Materialize.toast('Inventario agregado.', 3000, 'green accent-4');
						},
						function(error){
							Materialize.toast('Error al agregar Inventario.', 3000, 'green accent-4');
						}
						);
				}else{
					Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
				}
			},
			function(error){
				Materialize.toast('Ocurrió un error al insertar nueva computadora.', 3000, 'red accent-4');
			}
			);
	}else{
		if($scope.ckbSwitch){
			SwitchResource.save($scope.Switch).$promise.then(
				function(value){
					if(value.id_switch!=null){
						$scope.Inventario.switch_id=value.id_switch;
						InventarioResource.save($scope.Inventario).$promise.then(
							function(value){
								Materialize.toast('Inventario agregado.', 3000, 'green accent-4');
							},
							function(error){
								Materialize.toast('Error al agregar Inventario.', 3000, 'green accent-4');
							}
							);
					}else{
						Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
					}
				},
				function(error){
					Materialize.toast('Ocurrió un error al insertar switch.', 3000, 'red accent-4');
				}
				);
		}else{
			InventarioResource.save($scope.Inventario).$promise.then(
				function(value){
					Materialize.toast('Inventario agregado.', 3000, 'green accent-4');
				},
				function(error){
					Materialize.toast('Error al agregar Inventario.', 3000, 'green accent-4');
				}
				);
		}
	}
}
$timeout(function() {
	$location.path('/inventario/listaInventario');
}, 1000);
}
}else{
	Materialize.toast('El número de inventario ya existe.', 3000, 'red accent-4');
}
});
};

$scope.clickckbUsuarioNuevo = function(){
	if($scope.ckbUsuarioNuevo){
		$('#selectUsuario').attr('disabled',true);
		$('#selectUsuario').selectpicker('refresh');
		$scope.ckbUsuario=false;
	}
};
$scope.clickcheckboxUsuario = function(){
	if($scope.ckbUsuario){
		$scope.ckbUsuarioNuevo=false;
	}
};

$scope.clickcheckboxEquipo = function(){
	if($scope.ckbEquipoRed){
		$scope.ckbSwitch=false;
	}
};

$scope.clickcheckboxSwitch = function(){
	if($scope.ckbSwitch){
		$scope.ckbEquipoRed=false;
	}
};
$scope.ubicacionCambiada = function(){
	$scope.switches= SwitchResource.query({id_ubicacion:$scope.Inventario.ubicacion_id});
	$scope.switches.$promise.then(function(data) {
			if($scope.switches[0].id_switch!=0){
				$('#selectSwitch').attr('disabled',false);
			}else{
				$('#selectSwitch').attr('disabled',true);
			}
		});
};


});




function validateFormInventario($scope){
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
	}else if($scope.id_modelo_equipo==null){
		Materialize.toast('Debes seleccionar un modelo.', 3000, 'red accent-4');
		$('#selectModelo').selectpicker('toggle');
		return false;
	}
	if($scope.Inventario.ubicacion_id == null){
		Materialize.toast('Debes seleccionar una ubicación.', 3000, 'red accent-4');
		$('#selectUbicacionInventario').selectpicker('toggle');
		return false;
	}
	if($scope.Inventario.resguardante_id == null){
		Materialize.toast('Debes seleccionar un resguardante.', 3000, 'red accent-4');
		$('#selectResguardante').selectpicker('toggle');
		return false;
	}else{
		if($scope.ckbUsuario){
			if($scope.Inventario.encargado_id == null){
				Materialize.toast('Debes seleccionar un usuario.', 3000, 'red accent-4');
				$('#selectUsuario').selectpicker('toggle');
				return false;
			}
		}
	}
	if($scope.ckbUsuarioNuevo){
		if($scope.UsuarioNuevo.subarea_id == null){
			Materialize.toast('Debes seleccionar una subarea.', 3000, 'red accent-4');
			$('#selectSubarea').selectpicker('toggle');
			return false;
		}
		if($scope.UsuarioNuevo.ubicacion_id == null){
			Materialize.toast('Debes seleccionar una ubicación.', 3000, 'red accent-4');
			$('#selectUbicacion').selectpicker('toggle');
			return false;
		}
	}
	if($scope.ckbEquipoRed){
		if($scope.Computadora.antivirus_id == null){
			Materialize.toast('Debes seleccionar un Antivirus.', 3000, 'red accent-4');
			$('#selectAntivirus').selectpicker('toggle');
			return false;
		}
		if($scope.id_marca_sistema_operativo==null){
			Materialize.toast('Debes seleccionar una marca de S.O.', 3000, 'red accent-4');
			$('#selectMarcaSO').selectpicker('toggle');
			return false;
		}else if($scope.id_sistema_operativo==null){
			Materialize.toast('Debes seleccionar un Sistema Operativo.', 3000, 'red accent-4');
			$('#selectSO').selectpicker('toggle');
			return false;
		}else if($scope.Computadora.sistema_operativo_version_id==null){
			Materialize.toast('Debes seleccionar una versión de S.O.', 3000, 'red accent-4');
			$('#selectVersion').selectpicker('toggle');
			return false;
		}
		if($scope.ckbRedCableada){
			if($scope.Computadora.RedCableada.switch_id==null){
				Materialize.toast('Debes seleccionar un Switch.', 3000, 'red accent-4');
				$('#selectSwitch').selectpicker('toggle');
				return false;
			}
		}
	}
	return true;
}
'use strict';
angular.module('Client')
.controller('AdministrarEquiposCtrl',  function($scope, $location, $timeout,$window,InventarioResource,$routeParams,
	ClasificacionesTipoEquipoResource,TiposEquipoResource,MarcasEquipoResource,ModelosEquipoResource,
	TodosTipoEquipoResource,TodasMarcaEquipoResource,TodosModelosEquipoResource,TodasMarcaEquipoResourceDelete){
	$scope.includeCargado = function(){
		angular.forEach(angular.element('#nav-menu-administracion li'),function(value,key){
			angular.element(value).removeClass('active');
		});
		angular.element( document.querySelector( '#clasEquipos' )).addClass('active');
	};

	$scope.vistaAdministrarEquipo = 'clasificacion';

	$scope.clasificacionesTipoEquipo = ClasificacionesTipoEquipoResource.query();
	$scope.todosTiposEquipo = TodosTipoEquipoResource.query();
	$scope.todasMarcasEquipo = TodasMarcaEquipoResource.query();

	$scope.tiposEquipo = {};
	$scope.marcasEquipo = {};
	$scope.modelosEquipo = {};

	$scope.NuevaClasificacion={};
	$scope.NuevoTipo={};
	$scope.NuevaMarca={};
	$scope.NuevoModelo={};
	

	$scope.$on('ngRepeatMarcaFinished', function(ngRepeatMarcaFinished) {
		$("#selectMarca").selectpicker('refresh');
	});

	$scope.cambiarvista = function(){
		$scope.vistaAdministrarEquipo = 'clasificacion';
	}

	$scope.cambiarvista2 = function(){
		$scope.vistaAdministrarEquipo = 'tipo';
	}

	$scope.cambiarvista3 = function(){
		$scope.vistaAdministrarEquipo = 'marca';
	}

	$scope.agregarClasificacion = function(){
		if(buscarClasificacionExistente($scope.clasificacionesTipoEquipo,$scope.NuevaClasificacion.clasificacion_tipo_equipo)){
			Materialize.toast('Esa clasificación ya existe.', 3000, 'red accent-4');
		}else{
			ClasificacionesTipoEquipoResource.save($scope.NuevaClasificacion).$promise.then(
				function( value ){
					$scope.clasificacionesTipoEquipo = ClasificacionesTipoEquipoResource.query();
					Materialize.toast('Clasificación agregada.', 3000, 'green accent-4');
				},
				function( error ){
					Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
				}
				);
			$('#myModal').modal('hide');
		}
	};

	$scope.agregarTipo = function(){
		$scope.NuevoTipo.clasificacion_tipo_equipo_id = $scope.id_clasificacion_equipo_termporal;
		if(buscarTipoExistente($scope.todosTiposEquipo,$scope.NuevoTipo.tipo_equipo)){
			Materialize.toast('Ese tipo de equipo ya existe.', 3000, 'red accent-4');
		}else{
			TodosTipoEquipoResource.save($scope.NuevoTipo).$promise.then(
	        //success
	        function( value ){
	        	$scope.tiposEquipo= TiposEquipoResource.query({id:$scope.id_clasificacion_equipo_termporal});
	        	$scope.todosTiposEquipo = TodosTipoEquipoResource.query();
	        	Materialize.toast('Tipo agregado.', 3000, 'green accent-4');
	        },
	        //error
	        function( error ){
	        	Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
	        }
	        );
			$('#myModal2').modal('hide');
		}
	};

	$scope.agregarMarca = function(){
		if(validarFormMarca($scope)){
			if($scope.NuevaMarca.ckbMarca){
				$scope.NuevaMarca.id_marca_equipo=null;
			}
			$scope.NuevaMarca.tipo_equipo_id = $scope.id_tipo_equipo_temporal;
			TodasMarcaEquipoResource.save($scope.NuevaMarca).$promise.then(
				function( value ){
					$scope.marcasEquipo = MarcasEquipoResource.query({id:$scope.id_tipo_equipo_temporal});
					$scope.todasMarcasEquipo = TodasMarcaEquipoResource.query();
					Materialize.toast('Marca agregada.', 3000, 'green accent-4');
				},
				function( error ){
					Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
				}
				);
			$('#myModal3').modal('hide');
		}
	};

	$scope.agregarModelo = function(){
		$scope.NuevoModelo.marca_equipo_id = $scope.id_marca_equipo_temporal;
		$scope.NuevoModelo.tipo_equipo_id = $scope.id_tipo_equipo_temporal;
		if(buscarModeloExistente($scope.modelosEquipo,$scope.NuevoModelo.modelo_equipo)){
			Materialize.toast('Ese modelo ya existe.', 3000, 'red accent-4');
		}else{
			TodosModelosEquipoResource.save($scope.NuevoModelo).$promise.then(
				function( value ){
					$scope.modelosEquipo = ModelosEquipoResource.query({
						idMarca:$scope.id_marca_equipo_temporal,
						idTipo:$scope.id_tipo_equipo_temporal
					});
					Materialize.toast('Modelo agregado.', 3000, 'green accent-4');
					console.log("respuesta");
				},
				function( error ){
					Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
				}
				);
			console.log("cerrarmodal");
			$('#myModal4').modal('hide');
		}

	}

	$scope.verTipoEquipo = function(id,clasificacion){
		$scope.id_clasificacion_equipo_termporal = id;
		$scope.tiposEquipo= TiposEquipoResource.query({id:id});
		$scope.vistaAdministrarEquipo = 'tipo';
		$scope.tituloClasificacion=clasificacion;
	}

	$scope.verMarcaEquipo = function(id,tipo){
		$scope.id_tipo_equipo_temporal = id;
		$scope.marcasEquipo = MarcasEquipoResource.query({id:id});
		$scope.vistaAdministrarEquipo = 'marca';
		$scope.tituloTipo=tipo;
	}

	$scope.verModeloEquipo = function(id,marca){
		$scope.id_marca_equipo_temporal = id;
		$scope.modelosEquipo = ModelosEquipoResource.query({
			idMarca:id,
			idTipo:$scope.id_tipo_equipo_temporal
		});
		$scope.vistaAdministrarEquipo = 'modelo';
		$scope.tituloMarca=marca;
	}

	$scope.eliminarTemplate = function(id,nombreElemento,catalogo){
		$scope.id_eliminar_temporal=id;
		$scope.catalogo=catalogo;
		$scope.elementoEliminar=nombreElemento;
	}

	$scope.editarTemplate = function(id,nombreElemento,catalogo){
		$scope.id_editar_temporal = id;
		$scope.catalogo = catalogo;
		$scope.elementoEditar = nombreElemento;
	}

	$scope.eliminar = function (){
		switch($scope.catalogo){
			case 'clasificación':
				ClasificacionesTipoEquipoResource.delete({id: $scope.id_eliminar_temporal}).$promise.then(
					function(value){
						if(value.mensaje==='borrada'){
							$scope.clasificacionesTipoEquipo = ClasificacionesTipoEquipoResource.query();
							Materialize.toast('Clasificación eliminada.', 3000, 'green accent-4');
						}else{
							Materialize.toast('No se puede eliminar.', 3000, 'red accent-4');
						}
					},
					function(error){
						Materialize.toast('No se puede eliminar.', 3000, 'red accent-4');
					}
				);
				break;
			case 'tipo':
				TodosTipoEquipoResource.delete({id:$scope.id_eliminar_temporal}).$promise.then(
					function(value){
						if(value.mensaje==='borrado'){
							$scope.tiposEquipo= TiposEquipoResource.query({id:$scope.id_clasificacion_equipo_termporal});
	        				$scope.todosTiposEquipo = TodosTipoEquipoResource.query();
							Materialize.toast('Tipo eliminado.', 3000, 'green accent-4');
						}else{
							Materialize.toast('No se puede eliminar.', 3000, 'red accent-4');
						}
					},
					function(error){
						Materialize.toast('No se puede eliminar.', 3000, 'red accent-4');
					}
				);
				break;
			case 'marca':
				TodasMarcaEquipoResourceDelete.delete({
					id:$scope.id_eliminar_temporal,
					idTipo:$scope.id_tipo_equipo_temporal
				}).$promise.then(
					function(value){
						if(value.mensaje==='borrada'){
							$scope.marcasEquipo = MarcasEquipoResource.query({id:$scope.id_tipo_equipo_temporal});
							$scope.todasMarcasEquipo = TodasMarcaEquipoResource.query();
							Materialize.toast('Marca eliminada.', 3000, 'green accent-4');
						}else{
							Materialize.toast('No se puede eliminar.', 3000, 'red accent-4');
						}
					},
					function(error){
						Materialize.toast('No se puede eliminar.', 3000, 'red accent-4');
					}
				);
				break;
			case 'modelo':
				TodosModelosEquipoResource.delete({id:$scope.id_eliminar_temporal}).$promise.then(
					function(value){
						if(value.mensaje==='borrado'){
							$scope.modelosEquipo = ModelosEquipoResource.query({
								idMarca:$scope.id_marca_equipo_temporal,
								idTipo:$scope.id_tipo_equipo_temporal
							});
							Materialize.toast('Modelo eliminado.', 3000, 'green accent-4');
						}else{
							Materialize.toast('No se puede eliminar.', 3000, 'red accent-4');
						}
					},
					function(error){
						Materialize.toast('No se puede eliminar.', 3000, 'red accent-4');
					}
				);
				break;
			default:
				console.log("mala eleccion");
				break;
		}
		$('#myModalEliminar').modal('hide');
	}

	$scope.editar = function(){
		switch($scope.catalogo){
			case 'clasificación':
				if(buscarClasificacionExistente($scope.clasificacionesTipoEquipo,$scope.elementoEditar)){
					Materialize.toast('Esa clasificación ya existe.', 3000, 'red accent-4');
				}else{
					$scope.ClasificacionModificada = {};
					$scope.ClasificacionModificada.id_clasificacion_tipo_equipo=$scope.id_editar_temporal;
					$scope.ClasificacionModificada.clasificacion_tipo_equipo = $scope.elementoEditar;
					ClasificacionesTipoEquipoResource.update({id:$scope.ClasificacionModificada.id_clasificacion_tipo_equipo},$scope.ClasificacionModificada).$promise.then(
						function(value){
							if(value.mensaje==='modificada'){
								$scope.clasificacionesTipoEquipo = ClasificacionesTipoEquipoResource.query();
								Materialize.toast('Clasificación modificada.', 3000, 'green accent-4');
							}else{
								Materialize.toast('No se puede modificar.', 3000, 'red accent-4');
							}
						},
						function(error){
							Materialize.toast('No se puede modificar.', 3000, 'red accent-4');
						}
					);
					$('#myModalEditar').modal('hide');
				}
				break;
			case 'tipo':
				if(buscarTipoExistente($scope.todosTiposEquipo,$scope.elementoEditar)){
					Materialize.toast('Ese tipo ya existe.', 3000, 'red accent-4');
				}else{
					$scope.TipoModificado = {};
					$scope.TipoModificado.id_tipo_equipo=$scope.id_editar_temporal;
					$scope.TipoModificado.tipo_equipo = $scope.elementoEditar;
					TodosTipoEquipoResource.update({id:$scope.TipoModificado.id_tipo_equipo},$scope.TipoModificado).$promise.then(
						function(value){
							if(value.mensaje==='modificado'){
								$scope.tiposEquipo= TiposEquipoResource.query({id:$scope.id_clasificacion_equipo_termporal});
	        					$scope.todosTiposEquipo = TodosTipoEquipoResource.query();
								Materialize.toast('Tipo modificado.', 3000, 'green accent-4');
							}else{
								Materialize.toast('No se puede modificar.', 3000, 'red accent-4');
							}
						},
						function(error){
							Materialize.toast('No se puede modificar.', 3000, 'red accent-4');
						}
					);
					$('#myModalEditar').modal('hide');
				}
				break;
			case 'marca':
				if(buscarMarcaExistente($scope.todasMarcasEquipo,$scope.elementoEditar)){
					Materialize.toast('Esa marca ya existe.', 3000, 'red accent-4');
				}else{
					$scope.MarcaModificada = {};
					$scope.MarcaModificada.id_marca_equipo = $scope.id_editar_temporal;
					$scope.MarcaModificada.marca_equipo = $scope.elementoEditar;
					TodasMarcaEquipoResource.update({id:$scope.MarcaModificada.id_marca_equipo},$scope.MarcaModificada).$promise.then(
						function(value){
							if(value.mensaje==='modificada'){
								$scope.marcasEquipo = MarcasEquipoResource.query({id:$scope.id_tipo_equipo_temporal});
								$scope.todasMarcasEquipo = TodasMarcaEquipoResource.query();
								Materialize.toast('Marca modificada.', 3000, 'green accent-4');
							}else{
								Materialize.toast('No se puede modificar.', 3000, 'red accent-4');
							}
						},
						function(error) {
							Materialize.toast('No se puede modificar.', 3000, 'red accent-4');
						}
					);
					$('#myModalEditar').modal('hide');
				}
				break;
			case 'modelo':
				if(buscarModeloExistente($scope.modelosEquipo,$scope.elementoEditar)){
					Materialize.toast('Ese modelo ya existe.', 3000, 'red accent-4');
				}else{
					$scope.ModeloModificado = {};
					$scope.ModeloModificado.id_modelo_equipo = $scope.id_editar_temporal;
					$scope.ModeloModificado.modelo_equipo = $scope.elementoEditar;
					TodosModelosEquipoResource.update({id:$scope.ModeloModificado.id_modelo_equipo},$scope.ModeloModificado).$promise.then(
						function(value){
							if(value.mensaje==='modificado'){
								$scope.modelosEquipo = ModelosEquipoResource.query({
									idMarca:$scope.id_marca_equipo_temporal,
									idTipo:$scope.id_tipo_equipo_temporal
								});
								Materialize.toast('Modelo modificado.', 3000, 'green accent-4');
							}else{
								Materialize.toast('No se puede modificar.', 3000, 'red accent-4');
							}
						},
						function(error){
							Materialize.toast('No se puede modificar.', 3000, 'red accent-4');
						}
					);
					$('#myModalEditar').modal('hide');
				}
				break;
			default:
				console.log("mala eleccion");
				break;
		}
		
	}

});



function validarFormMarca ($scope) {
	if(!$scope.NuevaMarca.ckbMarca){
		if($scope.NuevaMarca.id_marca_equipo==null){
			Materialize.toast('Debes seleccionar una marca o poner una nueva.', 3000, 'red accent-4');
			return false;
		}
		if(buscarMarcaExistentePorID($scope.marcasEquipo,$scope.NuevaMarca.id_marca_equipo)){
			Materialize.toast('Esa marca ya está en este tipo de equipo.', 3000, 'red accent-4');
			return false;
		}
	}else{
		if(buscarMarcaExistente($scope.marcasEquipo,$scope.NuevaMarca.marca_equipo)){
			Materialize.toast('Esa marca ya está en este tipo de equipo.', 3000, 'red accent-4');
			$scope.NuevaMarca.marca_equipo='';
			return false;
		}else if(buscarMarcaExistente($scope.todasMarcasEquipo,$scope.NuevaMarca.marca_equipo)){
			Materialize.toast('Esa marca ya está en el catálogo.', 3000, 'red accent-4');
			$('#selectMarca').removeAttr('disabled');
			$('#selectMarca').selectpicker('refresh');
			$('#selectMarca').selectpicker('toggle');
			$scope.NuevaMarca.ckbMarca=false;
			$scope.NuevaMarca.marca_equipo='';
			return false;
		}
	}
	return true;
}

function buscarClasificacionExistente (array,palabra) {
	for (var i = 0; i < array.length; i++) {
		if(array[i].clasificacion_tipo_equipo.toLowerCase()===palabra.toLowerCase()){
			return true;
		}
	}
	return false;
}
function buscarTipoExistente (array,palabra) {
	for (var i = 0; i < array.length; i++) {
		if(array[i].tipo_equipo.toLowerCase()===palabra.toLowerCase()){
			return true;
		}
	}
	return false;
}

function buscarMarcaExistente(array,palabra){
	for(var i = 0; i < array.length; i++){
		if(array[i].marca_equipo.toLowerCase()===palabra.toLowerCase()){
			return true;
		}
	}
	return false;
}
function buscarMarcaExistentePorID(array,id){
	for(var i = 0; i < array.length; i++){
		if(array[i].id_marca_equipo==id){
			return true;
		}
	}
	return false;
}

function buscarModeloExistente(array,palabra){
	for (var i = 0; i < array.length; i++) {
		if(array[i].modelo_equipo.toLowerCase()===palabra.toLowerCase()){
			return true;
		}
	}
	return false;
}

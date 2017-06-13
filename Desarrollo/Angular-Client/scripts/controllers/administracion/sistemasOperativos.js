'use strict';
angular.module('Client')
.controller('AdministrarSOCtrl',  function($scope, $location, $timeout,$window,
	MarcaSistemaOperativoResource,VersionSistemaOperativoResource,
	TodosVersionSistemaOperativoResource,SistemaOperativoResource,TodosSistemaOperativoResource){
	$scope.includeCargado = function(){
		angular.forEach(angular.element('#nav-menu-administracion li'),function(value,key){
			angular.element(value).removeClass('active');
		});
		angular.element( document.querySelector( '#sistemasOperativos' )).addClass('active');
	};

	$scope.vistaAdministrarSO = 'marca';

	$scope.marcasSO = MarcaSistemaOperativoResource.query();


	$scope.NuevaMarca={};
	$scope.NuevoSO={};
	$scope.NuevaVersion={};
	

	$scope.cambiarvista = function(){
		$scope.vistaAdministrarSO = 'marca';
	}

	$scope.cambiarvista2 = function(){
		$scope.vistaAdministrarSO = 'so';
	}

	$scope.verSO = function(id,marca){
		$scope.id_marca_temporal = id;
		$scope.sistemasOperativos= SistemaOperativoResource.query({id_sistema_operativo:id});
		$scope.vistaAdministrarSO = 'so';
		$scope.tituloMarca=marca;
	}

	$scope.verVersion = function(id,so){
		$scope.id_so_temporal = id;
		$scope.versionesSO = VersionSistemaOperativoResource.query({id_sistema_operativo:id});
		$scope.vistaAdministrarSO = 'versiones';
		$scope.tituloso=so;
	}


	$scope.agregarMarca = function(){
		if(buscarMarcaSOExistente($scope.marcasSO,$scope.NuevaMarca.marca_sistema_operativo)){
			Materialize.toast('Esa marca ya existe.', 3000, 'red accent-4');
		}else{
			MarcaSistemaOperativoResource.save($scope.NuevaMarca).$promise.then(
				function( value ){
					$scope.marcasSO = MarcaSistemaOperativoResource.query();
					Materialize.toast('Marca agregada.', 3000, 'green accent-4');
				},
				function( error ){
					Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
				}
				);
			$('#myModal').modal('hide');
		}
	};

	$scope.agregarSO = function(){
		$scope.NuevoSO.marca_sistema_operativo_id = $scope.id_marca_temporal;
		if(buscarSOExistente($scope.sistemasOperativos,$scope.NuevoSO.sistema_operativo)){
			Materialize.toast('Ese Sistema Operativo ya existe.', 3000, 'red accent-4');
		}else{
			TodosSistemaOperativoResource.save($scope.NuevoSO).$promise.then(
	        //success
	        function( value ){
	        	$scope.sistemasOperativos= SistemaOperativoResource.query({
	        		id_sistema_operativo:$scope.id_marca_temporal
	        	});
	        	Materialize.toast('Sistema Operativo agregado.', 3000, 'green accent-4');
	        },
	        //error
	        function( error ){
	        	Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
	        }
	        );
			$('#myModal2').modal('hide');
		}
	};

	$scope.agregarVersion = function(){
		if(buscarVersionSOExistente($scope.versionesSO,$scope.NuevaVersion.version_sistema_operativo)){
			Materialize.toast('Esa Versión ya existe.', 3000, 'red accent-4');
		}else{
			$scope.NuevaVersion.sistema_operativo_id = $scope.id_so_temporal;
			TodosVersionSistemaOperativoResource.save($scope.NuevaVersion).$promise.then(
				function( value ){
					$scope.versionesSO = VersionSistemaOperativoResource.query({id_sistema_operativo:$scope.id_so_temporal});
					Materialize.toast('Versión agregada.', 3000, 'green accent-4');
				},
				function( error ){
					Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
				}
				);
			$('#myModal3').modal('hide');
		}
	};


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
			case 'marca':
				MarcaSistemaOperativoResource.delete({id_marca_sistema_operativo: $scope.id_eliminar_temporal}).$promise.then(
					function(value){
						if(value.mensaje==='borrada'){
							$scope.marcasSO = MarcaSistemaOperativoResource.query();
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
			case 'so':
				TodosSistemaOperativoResource.delete({id_sistema_operativo:$scope.id_eliminar_temporal}).$promise.then(
					function(value){
						if(value.mensaje==='borrado'){
							$scope.sistemasOperativos= SistemaOperativoResource.query({id_sistema_operativo:$scope.id_marca_temporal});
							Materialize.toast('Sistema Operativo eliminado.', 3000, 'green accent-4');
						}else{
							Materialize.toast('No se puede eliminar.', 3000, 'red accent-4');
						}
					},
					function(error){
						Materialize.toast('No se puede eliminar.', 3000, 'red accent-4');
					}
				);
				break;
			case 'version':
				TodosVersionSistemaOperativoResource.delete({id_version_sistema_operativo:$scope.id_eliminar_temporal}).$promise.then(
					function(value){
						if(value.mensaje==='borrada'){
							$scope.versionesSO = VersionSistemaOperativoResource.query({id_sistema_operativo:$scope.id_so_temporal});
							Materialize.toast('Versión eliminada.', 3000, 'green accent-4');
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
			case 'marca':
				if(buscarMarcaSOExistente($scope.marcasSO,$scope.elementoEditar)){
					Materialize.toast('Esa Marca ya existe.', 3000, 'red accent-4');
				}else{
					$scope.MarcaModificada = {};
					$scope.MarcaModificada.id_marca_sistema_operativo=$scope.id_editar_temporal;
					$scope.MarcaModificada.marca_sistema_operativo = $scope.elementoEditar;
					MarcaSistemaOperativoResource.update($scope.MarcaModificada).$promise.then(
						function(value){
							if(value.mensaje==='modificada'){
								$scope.marcasSO = MarcaSistemaOperativoResource.query();
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
			case 'so':
				if(buscarSOExistente($scope.sistemasOperativos,$scope.elementoEditar)){
					Materialize.toast('Ese Sistema Operativo ya existe.', 3000, 'red accent-4');
				}else{
					$scope.SOModificado = {};
					$scope.SOModificado.id_sistema_operativo=$scope.id_editar_temporal;
					$scope.SOModificado.sistema_operativo = $scope.elementoEditar;
					TodosSistemaOperativoResource.update($scope.SOModificado).$promise.then(
						function(value){
							if(value.mensaje==='modificado'){
								Materialize.toast('Sistema Operativo modificado.', 3000, 'green accent-4');
								$scope.sistemasOperativos= SistemaOperativoResource.query({id_sistema_operativo:$scope.id_marca_temporal});
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
			case 'version':
				if(buscarVersionSOExistente($scope.versionesSO,$scope.elementoEditar)){
					Materialize.toast('Esa versión ya existe.', 3000, 'red accent-4');
				}else{
					$scope.VersionModificada = {};
					$scope.VersionModificada.id_version_sistema_operativo = $scope.id_editar_temporal;
					$scope.VersionModificada.version_sistema_operativo = $scope.elementoEditar;
					TodosVersionSistemaOperativoResource.update($scope.VersionModificada).$promise.then(
						function(value){
							if(value.mensaje==='modificada'){
								$scope.versionesSO = VersionSistemaOperativoResource.query({id_sistema_operativo:$scope.id_so_temporal});
								Materialize.toast('Versión modificada.', 3000, 'green accent-4');
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
			default:
				console.log("mala eleccion");
				break;
		}
		
	}

});



function buscarMarcaSOExistente (array,palabra) {
	for (var i = 0; i < array.length; i++) {
		if(array[i].marca_sistema_operativo.toLowerCase()===palabra.toLowerCase()){
			return true;
		}
	}
	return false;
}
function buscarSOExistente (array,palabra) {
	for (var i = 0; i < array.length; i++) {
		if(array[i].sistema_operativo.toLowerCase()===palabra.toLowerCase()){
			return true;
		}
	}
	return false;
}

function buscarVersionSOExistente(array,palabra){
	for(var i = 0; i < array.length; i++){
		if(array[i].version_sistema_operativo.toLowerCase()===palabra.toLowerCase()){
			return true;
		}
	}
	return false;
}


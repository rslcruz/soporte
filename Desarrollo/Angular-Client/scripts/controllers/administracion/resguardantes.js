'use strict';

angular.module('Client')
.controller('ResguardanteCtrl', function($scope,$filter, $location, $timeout,$route,
	ResguardanteResource,UbicacionResource,ResguardantesResource) {
	$scope.includeCargado = function(){
		angular.forEach(angular.element('#nav-menu-administracion li'),function(value,key){
			angular.element(value).removeClass('active');
		});
		angular.element( document.querySelector( '#resguardantes' )).addClass('active');
	};

	$scope.sortType = 'nombre';
	$scope.sortReverse  = false; 
	$scope.resguardantes = ResguardanteResource.query();
	$scope.ubicaciones = UbicacionResource.query(); 
	$scope.subareas = ResguardantesResource.query();
	$scope.Resguardante={};

	$scope.pageSize = 25;
	$scope.currentPage = 1;
	$scope.search = '';

	$scope.getData = function () {
		return $filter('filter')($scope.resguardantes, $scope.search);
	};

	$scope.numberOfPages = function(){
		return Math.ceil($scope.getData().length/$scope.pageSize);                
	};

	$scope.arriba = function (){
		$("html, body").animate({ scrollTop: 0 }, 1000);
	}

	$scope.$on('ngRepeatUbicacionFinished', function(ngRepeatUbicacionFinished) {
		$("#selectUbicacion").selectpicker('refresh');
	});

	$scope.$on('ngRepeatSubareaFinished', function(ngRepeatUsuarioFinished) {
		$("#selectSubarea").selectpicker('refresh');
	});


	$scope.agregarResguardante = function(){
		if(validateFormResguardante($scope)){
			ResguardanteResource.save($scope.Resguardante).$promise.then(
				function(value){
					Materialize.toast('Resguardante creado.', 3000, 'green accent-4');
					$('#myModalCrearResguardante').modal('hide');
					$route.reload();
				},
				function(error){
					Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
				}
				);
		}
	};

	$scope.modalEditarResguardante = function(id_resguardante){
		$scope.ResguardanteEditado = ResguardanteResource.get({
			id_resguardante: id_resguardante
		});
		$scope.ResguardanteEditado.$promise.then(function(response){
			$timeout(function() {
				$("#selectSubareaEditar").selectpicker('refresh');
				$("#selectUbicacionEditar").selectpicker('refresh');
			});
		});
	};

	$scope.editarResguardante = function(){
		ResguardanteResource.update($scope.ResguardanteEditado).$promise.then(
			function(value){
				Materialize.toast('Resguardante editado.', 3000, 'green accent-4');
				$('#myModalEditarResguardante').modal('hide');
				$route.reload();
			},
			function(error){
				Materialize.toast('Ocurrió un error.', 3000, 'red accent-4');
			}
			);
	};

	$scope.limpiarFormResguardante = function(){
		$scope.Resguardante={};
	};
});

function validateFormResguardante($scope){
	if($scope.Resguardante.subarea_id == null){
		Materialize.toast('Debes seleccionar una subarea.', 3000, 'red accent-4');
		$('#selectSubarea').selectpicker('toggle');
		return false;
	}
	if($scope.Resguardante.ubicacion_id == null){
		Materialize.toast('Debes seleccionar una ubicación.', 3000, 'red accent-4');
		$('#selectUbicacion').selectpicker('toggle');
		return false;
	}
	return true;
}



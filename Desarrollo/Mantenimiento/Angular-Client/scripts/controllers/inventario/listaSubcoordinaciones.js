'use strict';

angular.module('Client')
.controller('ListaSubcoordinacionesCtrl',  function($scope, $location, $timeout,$window,AreaResource){
	$scope.includeCargado = function(){
		angular.forEach(angular.element('#nav-menu-inventario li'),function(value,key){
			angular.element(value).removeClass('active');
		});
		angular.element( document.querySelector( '#listaSubcoordinacionesLi' )).addClass('active');
	};

	$scope.Areas=AreaResource.query();

	$scope.$on('listaCompleta', function(ngRepeatFinishedEvent) {
        $('.collapsible').collapsible({
        	accordion : false 
        });
    });
});

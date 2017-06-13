'use strict';
angular.module('Client')
.controller('InicioCtrl', function($scope, $location, $timeout,$http) {
	angular.forEach(angular.element('#nav-menu-principal li'),function(value,key){
		angular.element(value).removeClass('active');
	});
	angular.element( document.querySelector( '#inicioLi' )).addClass('active');

});




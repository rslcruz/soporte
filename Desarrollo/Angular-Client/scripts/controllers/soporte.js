'use strict';

angular.module('Client')
.config(function($routeProvider){
	$routeProvider
	.when('/soporte/solicitudes',{
		templateUrl: 'views/soporte/solicitudes.html',
		controller: 'SoporteCtrl'
	})
	.when('/soporte/solicitudes/nueva', {
		templateUrl: 'views/soporte/solicitudes/crear.html',
		controller: 'SoporteCtrl'
	})
	.when('/soporte/solicitudes/editarAsignada/:id_solicitud_soporte', {
		templateUrl: 'views/soporte/solicitudes/editarAsignada.html',
		controller: 'SoporteCtrl'
	})
	.when('/soporte/solicitudes/editarProceso/:id', {
		templateUrl: 'views/soporte/solicitudes/editarProceso.html',
		controller: 'SoporteCtrl'
	})
	.when('/soporte/solicitudes/verSolicitud/:id_solicitud_soporte', {
		templateUrl: 'views/soporte/solicitudes/verSolicitud.html',
		controller: 'SoporteCtrl'
	});
})
.controller('SoporteCtrl', function($scope, $location, $timeout) {
	angular.forEach(angular.element('#nav-menu-principal li'),function(value,key){
		angular.element(value).removeClass('active');
	});
	angular.element( document.querySelector( '#sporteLi' )).addClass('active');

	
});
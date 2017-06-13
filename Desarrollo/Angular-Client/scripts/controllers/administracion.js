'use strict';

angular.module('Client')
.config(function($routeProvider){
	$routeProvider
	.when('/administracion/usuarios', {
		templateUrl: 'views/administracion/admUsuarios.html',
		controller: 'AdministracionCtrl'
	})
	.when('/administracion/empresas', {
		templateUrl: 'views/administracion/admEmpresas.html',
		controller: 'AdministracionCtrl'
	})
	.when('/administracion/antivirus', {
		templateUrl: 'views/administracion/admAntivirus.html',
		controller: 'AdministracionCtrl'
	})
	.when('/administracion/sistemasOperativos', {
		templateUrl: 'views/administracion/admSistemasOperativos.html',
		controller: 'AdministracionCtrl'
	})
	.when('/administracion/ubicaciones', {
		templateUrl: 'views/administracion/admUbicaciones.html',
		controller: 'AdministracionCtrl'
	})
	.when('/administracion/resguardantes', {
		templateUrl: 'views/administracion/admResguardantes.html',
		controller: 'AdministracionCtrl'
	})
	.when('/administracion/catEquipos', {
		templateUrl: 'views/administracion/admCatEquipos.html',
		controller: 'AdministracionCtrl'
	});
	
})
.controller('AdministracionCtrl', function($scope, $location, $timeout) {
	angular.forEach(angular.element('#nav-menu-principal li'),function(value,key){
		angular.element(value).removeClass('active');
	});
	angular.element( document.querySelector( '#admLI' )).addClass('active');
});
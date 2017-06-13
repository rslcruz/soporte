'use strict';

angular.module('Client')
.config(function($routeProvider){
	$routeProvider
	.when('/inventario/agregar', {
		templateUrl: 'views/inventario/agregar.html',
		controller: 'InventarioCtrl'
	})
	.when('/inventario/listaSubcoordinaciones', {
		templateUrl: 'views/inventario/listaSubcoordinaciones.html',
		controller: 'InventarioCtrl'
	})
	.when('/inventario/listaInventario/:id/:name', {
		templateUrl: 'views/inventario/listaInventario.html',
		controller: 'InventarioCtrl'
	})
	.when('/inventario/listaInventario', {
		templateUrl: 'views/inventario/listaInventario.html',
		controller: 'InventarioCtrl'
	})
	.when('/inventario/:id', {
		templateUrl: 'views/inventario/inventario.html',
		controller: 'InventarioCtrl'
	});
})
.controller('InventarioCtrl', function($scope, $location, $timeout) {
	angular.forEach(angular.element('#nav-menu-principal li'),function(value,key){
		angular.element(value).removeClass('active');
	});
	angular.element( document.querySelector( '#inventarioLi' )).addClass('active');
});
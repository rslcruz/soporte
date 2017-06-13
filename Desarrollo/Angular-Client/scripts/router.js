'use strict';
var dir="../API/public/";
angular.module('Client',['ngResource','ngRoute','satellizer','ngStorage','angularMoment',
	'ui.bootstrap.datetimepicker','ui.bootstrap','daterangepicker'])
	.config(function($routeProvider, $authProvider){
		$authProvider.loginUrl = 'API/public/auth';
		$routeProvider
		.when('/usuarios',{
			templateUrl: 'views/usuario/index.html',
			controller: 'IndexUsuarioCtrl'
		})
		.when('/usuarios/new',{
			templateUrl: 'views/usuario/create.html',
			controller: 'CreateUsuarioCtrl'
		})
		.when('/usuarios/edit/:id',{
			templateUrl: 'views/usuario/create.html',
			controller: 'EditUsuarioCtrl'
		})
		.when('/inicio', {
			templateUrl: 'views/inicio.html',
			controller:'InicioCtrl'
		})

        .when('/prueba', {
			templateUrl: 'prueba.html', 
			controller: 'InicioCtrl'
		})

		.when('/login', {
			templateUrl: 'views/login.html', 
			controller: 'LoginCtrl' 
		})
		.otherwise({
			redirectTo: '/inicio'
		});
	})
	.run( function($rootScope, $location,$auth) {
	    // register listener to watch route changes
	    $rootScope.$on( "$routeChangeStart", function(event, next, current) {
	      if ( !$auth.isAuthenticated() ) {
	        // no logged user, we should be going to #login
	        if ( next.templateUrl == "views/login.html" ) {
	          // already going to #login, no redirect needed
	        } else {
	          // not going to #login, we should redirect now
	          $location.path( "/login" );
	        }
	      }    
	    });
	 })
	.controller('MainCtrl', function($rootScope,$scope,$auth,$location,$localStorage,$sessionStorage) {
		
		$rootScope.UsuarioLogueado = $sessionStorage.UsuarioLogueado;

    	$scope.isAuthenticated = function() {
		  return $auth.isAuthenticated();
		};

		$scope.isAdministrator = function(){
			return $rootScope.UsuarioLogueado.usuarioperfil.id_usuario_perfil === 1;
		};

		$scope.isMesaAyuda = function(){
			return $rootScope.UsuarioLogueado.usuarioperfil.id_usuario_perfil === 2;
		};

		$scope.isCTecnico = function(){
			return $rootScope.UsuarioLogueado.usuarioperfil.id_usuario_perfil === 3;
		};

		$scope.isCRed = function(){
			return $rootScope.UsuarioLogueado.usuarioperfil.id_usuario_perfil === 4;
		};

		$scope.isCTelefonia = function(){
			return $rootScope.UsuarioLogueado.usuarioperfil.id_usuario_perfil === 5;
		};

		$scope.isTecnico = function(){
			return $rootScope.UsuarioLogueado.usuarioperfil.id_usuario_perfil === 6;
		};


		$scope.logout = function(){
			$sessionStorage.$reset();
			$auth.logout();
			$location.path('/login');
		};
    })
    .directive('onFinishRender', function ($timeout) {
	return {
		restrict: 'A',
		link: function (scope, element, attr) {
			if (scope.$last === true) {
				$timeout(function () {
					scope.$emit(attr.onFinishRender);
				});
			}
		}
	}
});
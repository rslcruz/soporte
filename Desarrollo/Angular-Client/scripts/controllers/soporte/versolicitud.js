'use strict'; 

angular.module('Client')
.controller('verSolicitudCtrl',  function($scope,$rootScope, $location, $timeout,$routeParams,$window,SolicitudResource){
	$scope.includeCargado = function(){
		angular.forEach(angular.element('#nav-menu-soporte li'),function(value,key){
			angular.element(value).removeClass('active');
		});
		angular.element(document.querySelector( '#solicitudesLi')).addClass('active');
	};
	$scope.prueba='Controlador2';
	console.log(1);
	$scope.Solicitud = SolicitudResource.get({
		id_solicitud_soporte: $routeParams.id_solicitud_soporte
	});


  

	$scope.resguardante= function(res){
     // console.log(9999999);
			if (res===null || res==="") {  
				$scope.vistaResguardante='sinResguardante';	               		
          }
            else{				
				$scope.vistaResguardante='reguardanteStore';			
              }
              // console.log(8888888);
	};




$scope.imprimir = function(){
		window.print();
	}

   	$scope.dateFormat = function(date){

      $scope.fecha=date.substr(0,10);
      $scope.hora=date.substr(11,8);
      return $scope.fecha+" a las "+$scope.hora;
	
   	};


   		$scope.dateFormat2 = function(date){
           if (date!=null) {
           $scope.fecha=date.substr(0,10);
          return $scope.fecha;		
    }
       else{ 
        $scope.fecha="";
		return $scope.fecha;
       }
	
   	};

   		$scope.dateFormat3 = function(date){

      if (date!=null) {
      	$scope.hora=date.substr(11,5);
       return $scope.hora;
      }

      else{

      	$scope.hora="";
      }
      
	
   	};

	
	




	
});


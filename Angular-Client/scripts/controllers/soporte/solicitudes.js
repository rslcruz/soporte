'use strict';

angular.module('Client')
.controller('SolicitudesCtrl',  function($scope, $location, $timeout,$window,SolicitudResource,$modal){
	$scope.includeCargado = function(){
		angular.forEach(angular.element('#nav-menu-soporte li'),function(value,key){
			angular.element(value).removeClass('active');
		});
		angular.element( document.querySelector( '#solicitudesLi' )).addClass('active');
	};

	$scope.solicitudesCargadas = false;
	$scope.tab = 'asignadas';
	$scope.prueba= 'hola';
	$scope.Solicitudes = SolicitudResource.query();
	
	$scope.SolicitudesAsignadas = [];	
	$scope.SolicitudesProceso = [];	
	$scope.SolicitudesLaboratorio = [];	
	$scope.SolicitudesGarantia = [];	
	$scope.SolicitudesCotizar = [];	
	$scope.SolicitudesAutorizacion = [];	
	$scope.SolicitudesRefaccion = [];	
	$scope.SolicitudesConcluir = [];	
	$scope.SolicitudesConcluidas = [];	
	$scope.SolicitudesCanceladas = [];		


	$scope.Solicitudes.$promise.then(function(response) {
		var cantidad = 0;
		angular.forEach(response, function(value, key){
		     switch(value.estatus_solicitud_id){
				case 1:
					$scope.SolicitudesAsignadas.push({value});
					break;
				case 2:
					$scope.SolicitudesProceso.push({value});
					break;
				case 3:
					$scope.SolicitudesLaboratorio.push({value});
					break;
				case 4:
					$scope.SolicitudesGarantia.push({value});
					break;
				case 5:
					$scope.SolicitudesCotizar.push({value});
					break;
				case 6:
					$scope.SolicitudesAutorizacion.push({value});
					break;
				case 7:
					$scope.SolicitudesRefaccion.push({value});
					break;
				case 8:
					$scope.SolicitudesConcluir.push({value});
					break;
				case 9:
					$scope.SolicitudesConcluidas.push({value});
					break;
				case 10:
					$scope.SolicitudesCanceladas.push({value});
					break;
				default:
					console.log('error');
					break;
			}
		});
   	});

   	$scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
        $scope.solicitudesCargadas = true;
    });

   	$scope.dateFormat = function(date){
		return moment(date).format('DD/MM/YYYY - h:mm a'); 
   	};

   	$scope.setResguardante = function(inventario){
   		if(inventario.encargado!=null){
   			return inventario.encargado.nombre+" "+inventario.encargado.apellido_paterno+" "+inventario.encargado.apellido_materno;
   		}else{
   			return inventario.resguardante.nombre+" "+inventario.resguardante.apellido_paterno+" "+inventario.resguardante.apellido_materno;
   		}
   	}

	$scope.timediff = function( fecha){
		var tiempo='';
		var fechaAhora= new Date();

		var dateB = moment(fechaAhora);
		var dateC = moment(fecha);

		function dhm(t){
		    var cd = 24 * 60 * 60 * 1000,
		        ch = 60 * 60 * 1000,
		        d = Math.floor(t / cd),
		        h = Math.floor( (t - d * cd) / ch),
		        m = Math.round( (t - d * cd - h * ch) / 60000),
		        pad = function(n){ return n < 10 ? n : n; };
						  if( m === 60 ){
						    h++;
						    m = 0;
						  }
						  if( h === 24 ){
						    d++;
						    h = 0;
					}
		  return [d, pad(h), pad(m)] ;
		}
		var tiempoTranscurrido= dhm(dateB.diff(dateC));
		var dias = tiempoTranscurrido[0];
		var horas = tiempoTranscurrido[1];
		var minutos = tiempoTranscurrido[2];

		(dias>0) ? ( (dias>1)? tiempo+=dias+' días ': tiempo+=dias+' día, ') : tiempo+='';
		(horas>0) ? ( (horas>1)? tiempo+=horas+' horas y ': tiempo+=horas+' horas y ') : tiempo+='';
		(minutos>0) ? ( (minutos>1)? tiempo+=minutos+' minutos': tiempo+=minutos+' minuto') : tiempo+='';

		return (tiempo=='')? 'Ninguno' : tiempo;
	};



	$scope.showModal=function(){

		$scope.lista={};
		var verModal = $modal.open({
			templateUrl:'views/prueba.html'


		})



	}

});

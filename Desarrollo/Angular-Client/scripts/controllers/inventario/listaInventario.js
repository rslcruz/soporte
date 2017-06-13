'use strict';


angular.module('Client')
.controller('ListaInventarioCtrl',  function($scope, $location,$filter,$routeParams,$timeout,
    InventarioResource,InventarioSubareaResource,InventarioResourceComputadoras,
    ComputadorasFullResource,InventarioFullResource){
	$scope.includeCargado = function(){
		angular.forEach(angular.element('#nav-menu-inventario li'),function(value,key){
			angular.element(value).removeClass('active');
		});
		angular.element( document.querySelector( '#listaInventarioLi' )).addClass('active');
	};

    $scope.search={};

    $scope.date = {
        startDate: null,
        endDate: null
    };

    $scope.soloComputadoras=1;
    $scope.cargandoInventario=true;
    $scope.exportando=false;
    $scope.listaVacia=false;
    $scope.filterComputadoras=false;

    if($routeParams.id!=null){
        $scope.Inventarios = InventarioSubareaResource.query({id: $routeParams.id});
        $scope.title=" - "+$routeParams.name;
    }else{
       $scope.Inventarios = InventarioResource.query();
        $scope.title="";
    }

    $scope.Inventarios.$promise.then(function(response) {
        if($scope.getData().length<1){
            $scope.listaVacia=true;
        }
    });

    $scope.Compu={};
    $scope.Compu.pc='todo';

    $scope.options=[
        {"id":'todo','name':'Todos los Equipos'},
        {"id":'computadoras','name':'Computadoras'}
    ];

    $timeout(function() {
        $("#selectSoloComputadoras").selectpicker('refresh');
    });

    $scope.limpiarFiltros = function(){
        $scope.search={};
        $scope.date = {
            startDate: null,
            endDate: null
        };
    };

    $scope.exportar = function(tipoExportar){
        $scope.exportando=true;
        $scope.listaExportada=[];
        switch(tipoExportar){
            case 1:
                $scope.listaExportada= InventarioResource.query();
                $scope.listaExportada.$promise.then(function(response) {
                    var query='SELECT ';
                    query+='id_inventario as Codigo,';
                    query+='concat(resguardante->nombre," ",resguardante->apellido_paterno," ",resguardante->apellido_materno) as Resguardante,';
                    query+='descripcion as Equipo,';
                    query+='modelo->tipo_marca_equipo->tipo_equipo->tipo_equipo as Tipo,';
                    query+='modelo->tipo_marca_equipo->marca_equipo->marca_equipo as Marca,';
                    query+='modelo->modelo_equipo as Modelo,';
                    query+='serie as Serie,';
                    query+='activo as Activo,';
                    query+='fecha_alta as Fecha_de_alta,';
                    query+='responsiva_firmada as Firma_responsiva';
                    alasql(query+' INTO XLSX("Inventario.xlsx",{headers:true}) FROM ?',[$scope.listaExportada]);
                    $scope.exportando=false;
                });
                break;
            case 2:
                
                break;
            case 3:
                $scope.listaExportada= InventarioResourceComputadoras.query();
                $scope.listaExportada.$promise.then(function(response) {
                    var query='SELECT ';
                    query+='id_inventario as Codigo,';
                    query+='concat(resguardante->nombre," ",resguardante->apellido_paterno," ",resguardante->apellido_materno) as Resguardante,';
                    query+='descripcion as Equipo,';
                    query+='modelo->tipo_marca_equipo->marca_equipo->marca_equipo as Marca,';
                    query+='modelo->modelo_equipo as Modelo,';
                    query+='computadora->ip as Ip,';
                    query+='computadora->mac_address as Mac_Adress,';
                    query+='computadora->antivirus->antivirus as Antivirus,';
                    query+='serie as Serie,';
                    query+='activo as Activo,';
                    query+='fecha_alta as Fecha_de_alta,';
                    query+='responsiva_firmada as Firma_responsiva';
                    alasql(query+' INTO XLSX("InventarioComputadoras.xlsx",{headers:true}) FROM ?',[$scope.listaExportada]);
                    $scope.exportando=false;
                });
                break;
            case 4:
                
                break;
            default:
                console.log("error de opcion exportar");
                break;
        }
        
    };

   

    $scope.soloComputadorasFunction=function () {
        $scope.cargandoInventario=true;
        $scope.limpiarFiltros();
        if($scope.Compu.pc=='computadoras'){
            $scope.Inventarios = InventarioResourceComputadoras.query();
            $scope.filterComputadoras=true;
        }else{
            $scope.Inventarios = InventarioResource.query();
            $scope.filterComputadoras=false;
        }
        $timeout(function() {
            $scope.currentPage = 1;
        });
    }

    $scope.paginationRender = function(){
        $scope.pageSize = 100;
        $scope.currentPage = 1;
        $scope.search = '';  
    }
	
    $scope.paginationRender(); 

    $scope.dateFormat = function(date){
        return moment(date).format('DD/MM/YYYY'); 
    };

	$scope.getData = function () {
      var listaFiltroTexto = $filter('filter')($scope.Inventarios, $scope.search);
      var listaFiltroFecha = $filter('myfilterDate')(listaFiltroTexto,$scope.date.startDate,$scope.date.endDate);
      return listaFiltroFecha;
    };

	$scope.numberOfPages=function(){
        return Math.ceil($scope.getData().length/$scope.pageSize);                
    };

    $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
        $scope.cargandoInventario=false;
    });
});

angular.module('Client')
.filter('startFrom', function() {
    return function(input, start) {
        start = +start;
        return input.slice(start);
    }
})
.filter('range', function() {
  return function(input, min, max) {
    min = parseInt(min); //Make string input int
    max = parseInt(max);
    for (var i=min; i<max+1; i++)
      input.push(i);
    return input;
  };
})
.filter("myfilterDate", function() {
  return function(items, from, to) {
        var arrayToReturn = [];  

        if (!from || !to) {
            return items;
        }
        angular.forEach(items, function(obj){
            var fechaFormat = moment(obj.fecha_alta);
            if(moment(fechaFormat).isAfter(from) && moment(fechaFormat).isBefore(to)) {
                arrayToReturn.push(obj);
            }
        });
        return arrayToReturn;
  };
});


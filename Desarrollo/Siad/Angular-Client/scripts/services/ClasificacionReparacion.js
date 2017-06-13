'use strict';

angular.module('Client')
.factory('ClasificacionReparacionResource', function($resource) {
	return $resource(dir+"clasificacionReparacion/:id_clasificacion_reparacion", {
		id_clasificacion_reparacion: "@id_clasificacion_reparacion"
	}, {
		update: {
			method: "PUT"
		},get: {
        	method: 'GET',
        	isArray: true
    	}
	});
});
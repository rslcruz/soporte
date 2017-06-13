'use strict';

angular.module('Client')
.factory('SubclasificacionReparacionResource', function($resource) {
	return $resource(dir+"subclasificacionReparacion/:id_subclasificacion_reparacion", {
		id_clasificacion_reparacion: "@id_subclasificacion_reparacion"
	}, {
		update: {
			method: "PUT"
		},get: {
        	method: 'GET',
        	isArray: true
    	}
	});
});
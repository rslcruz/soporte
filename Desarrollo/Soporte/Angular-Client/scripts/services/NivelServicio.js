'use strict';

angular.module('Client')
.factory('NivelServicioResource', function($resource) {
	return $resource(dir+"niveldeservicio/:id_nivel_servicio", {
		id_nivel_servicio: "@id_nivel_servicio"
	}, {
		update: {
			method: "PUT"
		},get: {
        	method: 'GET',
        	isArray: true
    	}
	});
});
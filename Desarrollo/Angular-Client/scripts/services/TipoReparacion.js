'use strict';

angular.module('Client')
.factory('TipoReparacionResource', function($resource) {
	return $resource(dir+"tipoReparacion/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
});
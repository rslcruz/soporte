'use strict';

angular.module('Client')
.factory('UbicacionResource', function($resource) {
	return $resource(dir+"ubicaciones/:id_ubicacion", {
		id_ubicacion: "@id_ubicacion"
	}, {
		update: {
			method: "PUT"
		}
	});
});
'use strict';

angular.module('Client')
.factory('SwitchResource', function($resource) {
	return $resource(dir+"switches/:id_ubicacion", {
		id_ubicacion: "@id_ubicacion"
	}, {
		update: {
			method: "PUT"
		}
	});
});
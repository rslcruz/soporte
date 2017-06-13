'use strict';

angular.module('Client')
.factory('ServicioResource', function($resource) {
	return $resource(dir+"servicios/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
});
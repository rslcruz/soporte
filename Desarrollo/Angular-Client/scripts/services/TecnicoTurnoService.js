'use strict';

angular.module('Client')
.factory('TecnicoTurnoResource', function($resource) {
	return $resource(dir+"tecnicoturno/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
});
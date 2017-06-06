'use strict';

angular.module('Client')
.factory('TecnicoResource', function($resource) {
	return $resource(dir+"tecnicos/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
});
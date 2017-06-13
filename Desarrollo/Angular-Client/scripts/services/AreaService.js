'use strict';

angular.module('Client')
.factory('AreaResource', function($resource) {
	return $resource(dir+"areas/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
});
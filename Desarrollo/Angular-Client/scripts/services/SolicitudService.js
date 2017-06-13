'use strict';

angular.module('Client')
.factory('SolicitudResource', function($resource) {
	return $resource(dir+"solicitudes/:id_solicitud_soporte", {
		id_solicitud_soporte: "@id_solicitud_soporte"
	}, {
		update: {
			method: "PUT"
		}
	});
}) 
.factory('SolicitudPDFResource', function($resource) {
	return $resource(dir+"solicitudes/:id_solicitud_soporte", {
		id_solicitud_soporte: "@id_solicitud_soporte"
	}, {
		update: {
			method: "PUT"
		}
	});
}); 
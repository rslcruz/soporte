'use strict';

angular.module('Client')
.factory('UsuarioResource', function($resource) {
	return $resource(dir+"usuarios/:id_usuario", {
		id_usuario: "@id_usuario"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('PerfilResource', function($resource) {
	return $resource(dir+"perfiles/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('EmpresaResource', function($resource) {
	return $resource(dir+"empresas/:id_empresa", {
		id_empresa: "@id_empresa"
	}, {
		update: {
			method: "PUT"
		}
	});
});

//return $resource(dir+"empresas/:id_empresa", {
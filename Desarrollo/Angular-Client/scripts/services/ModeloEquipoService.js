'use strict';

angular.module('Client')
.factory('ClasificacionesTipoEquipoResource', function($resource) {
	return $resource(dir+"clasificacionesTipoEquipo/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('TiposEquipoResource', function($resource) {
	return $resource(dir+"tiposEquipo/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('MarcasEquipoResource', function($resource) {
	return $resource(dir+"marcasEquipo/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('ModelosEquipoResource', function($resource) {
	return $resource(dir+"modelosEquipo/:idMarca/:idTipo", {
		idMarca: "@idMarca",
		idTipo: "@idTipo"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('TodosTipoEquipoResource', function($resource) {
	return $resource(dir+"tipoEquipo/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('TodasMarcaEquipoResource', function($resource) {
	return $resource(dir+"marcaEquipo/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('TodasMarcaEquipoResourceDelete', function($resource) {
	return $resource(dir+"marcaEquipo/:id/:idTipo", {
		id: "@id",
		idTipo:"@idTipo"
	});
})
.factory('TodosModelosEquipoResource', function($resource) {
	return $resource(dir+"modeloEquipo/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
});


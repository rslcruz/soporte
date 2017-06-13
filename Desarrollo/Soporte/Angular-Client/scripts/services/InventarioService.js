'use strict';

angular.module('Client')
.factory('InventarioResource', function($resource) {
	return $resource(dir+"inventarios/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('InventarioResourceComputadoras', function($resource) {
	return $resource(dir+"inventariosComputadoras/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('InventarioSubareaResource', function($resource) {
	return $resource(dir+"inventariosSubarea/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('ResguardantesResource', function($resource) {
	return $resource(dir+"resguardantesSubareas/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('ResguardanteResource', function($resource) {
	return $resource(dir+"resguardantes/:id_resguardante", {
		id_resguardante: "@id_resguardante"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('UsuarioEquipoResource', function($resource) {
	return $resource(dir+"usuariosEquipo/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('ComputadoraResource', function($resource) {
	return $resource(dir+"computadoras/:id_computadora", {
		id_computadora: "@id_computadora"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('TodosSistemaOperativoResource', function($resource) {
	return $resource(dir+"sistemasOperativos/:id_sistema_operativo", {
		id_sistema_operativo: "@id_sistema_operativo"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('SistemaOperativoResource', function($resource) {
	return $resource(dir+"sistemasOperativo/:id_sistema_operativo", {
		id_sistema_operativo: "@id_sistema_operativo"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('TodosVersionSistemaOperativoResource', function($resource) {
	return $resource(dir+"versionesSistemaOperativo/:id_version_sistema_operativo", {
		id_version_sistema_operativo: "@id_version_sistema_operativo"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('VersionSistemaOperativoResource', function($resource) {
	return $resource(dir+"versionesSistemaOperativos/:id_sistema_operativo", {
		id_sistema_operativo: "@id_sistema_operativo"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('MarcaSistemaOperativoResource', function($resource) {
	return $resource(dir+"marcasSistemaOperativo/:id_marca_sistema_operativo", {
		id_marca_sistema_operativo: "@id_marca_sistema_operativo"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('AntivirusResource', function($resource) {
	return $resource(dir+"antivirus/:id_antivirus", {
		id_antivirus: "@id_antivirus"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('ComputadorasFullResource', function($resource) {
	return $resource(dir+"getComputadorasFull/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
})
.factory('InventarioFullResource', function($resource) {
	return $resource(dir+"getInventario/:id", {
		id: "@id"
	}, {
		update: {
			method: "PUT"
		}
	});
});

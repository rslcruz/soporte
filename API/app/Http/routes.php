<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('prueba', function () {
    return view('vista');
});

Route::resource('servicios','ServicioController');
Route::resource('usuarios','UsuarioController');
Route::resource('empresas','EmpresaController');	
Route::resource('perfiles','PerfilController');
Route::resource('tecnicos','TecnicoController');
Route::resource('areas','AreaController');
Route::resource('solicitudes','SolicitudController');
Route::resource('inventarios','InventarioController');
Route::resource('resguardantes','ResguardanteController');
Route::resource('usuariosEquipo','UsuarioEquipoController');	
Route::resource('antivirus','AntivirusController');	
Route::resource('switches','SwitchController');
Route::resource('computadoras','ComputadoraController');
Route::resource('pruebainventario','pruebaInventarioController');
Route::resource('tecnicoturno','TecnicoTurnoController');
Route::resource('tipoReparacion','TipoReparacionController');

Route::resource('niveldeservicio','NivelServicioController');

Route::resource('subclasificacionReparacion','SubclasificacionReparacionController');
route::get(
	'subclasificacionReparacionBase/{id_subclasificacion_reparacion}',
	'SubclasificacionReparacionController@getsubclasificacionReparacion'
	);


Route::resource('clasificacionReparacion','ClasificacionReparacionController');
route::get(
	'clasificacionReparacionBase/{id_clasificacion_reparacion}',
	'ClasificacionReparacionController@getclasificacionReparacion'
	);
Route::get(
	'solicitudpdf/{id_solicitud_soporte}','SolicitudController@getsolicitudpdf');



Route::get('ReportePDF/{id_solicitud_soporte}','SolicitudController@getReporteSolicitudPDF');
//Route::get('solicitudpdf/{id_solicitud_soporte}','SolicitudController@solicitudpdf');






Route::resource('versionesSistemaOperativo','VersionSistemaOperativoController');
Route::get(
	'versionesSistemaOperativos/{id_sistema_operativo}',
	'VersionSistemaOperativoController@getVersionesSistemaOperativo'
	);
Route::resource('sistemasOperativos','SistemaOperativoController');
Route::get(
	'sistemasOperativo/{id_sistema_operativo}',
	'SistemaOperativoController@getSistemaOperativo'
	);

Route::resource('marcasSistemaOperativo','MarcaSistemaOperativoController');


Route::resource('clasificacionesTipoEquipo','ModeloEquipoController');
Route::resource('tipoEquipo', 'TipoEquipoController');
Route::resource('marcaEquipo', 'MarcaEquipoController');
Route::resource('modeloEquipo','ModeloBuenoEquipoController');

Route::delete('marcaEquipo/{id}/{idTipo}', 'MarcaEquipoController@destroy');

Route::get('tiposEquipo/{id}','ModeloEquipoController@getTiposEquipo');
Route::get('marcasEquipo/{id}','ModeloEquipoController@getMarcasEquipo');	
Route::get('modelosEquipo/{idMarca}/{idTipo}','ModeloEquipoController@getModelosEquipo');

Route::get('inventariosComputadoras','InventarioController@getComputadoras');
	
Route::get('resguardantesSubareas','InventarioController@getResguardanteSubareas');
Route::get('inventariosSubarea/{id}', 'InventarioController@getSubarea');
Route::get('inventarioExistente/{id}', 'InventarioController@inventarioExistente');

Route::get('getInventario','InventarioController@getInventario');
Route::get('getComputadorasFull','InventarioController@getComputadorasFull');

Route::resource('ubicaciones','UbicacionController');
Route::post('auth', 'AuthenticateController@auth');
/*Route::group(['middleware' => 'cors'], function() {
    Route::post('auth', 'AuthenticateController@auth');
});*/




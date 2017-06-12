<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Cotizaciones extends Model
{
    protected $primaryKey = 'id_cotizaciones';
    protected $table = 'cotizaciones';
	protected $fillable = [
	'cantidad',
	'subtotal',
	'importe',
	'anio',
	'status',
	'tiempo_estimado',
	'fecha_elaborado',
	'fecha_entrega',
	'fecha_autorizado',
	'factura',
	'num_proyecto',
	'id_almequi_resguardante',
	'id_soportes',
	'id_cotizaciones_refaccion'];


	protected $casts = [
	'id_cotizaciones'              => 'integer',
	'cantidad'                     => 'double',
	'subtotal'                     => 'double',
	'importe'                      => 'double',
	//'anio'                         => 'date',
	'status'                       => 'integer',
	//'tiempo_estimado'              => 'datetime',
	//'fecha_elaborado'              => 'datetime',
	//'fecha_entrega'                => 'datetime',
	//'fecha_autorizado'             => 'datetime',
	'factura'                      => 'integer',
	'num_proyecto'                 => 'string',
	'id_almequi_resguardante'      => 'integer',
	'id_soportes'                  => 'integer',
	'id_cotizaciones_refaccion'    => 'integer',  

    ];

        public function soportes(){
		return $this->hasMany('API\id_soportes');
			}

	public function cotizacionesrefaccion(){
		return $this->belongsTo('API\Cotizaciones_refaccion','id_cotizaciones_refaccion');
			}


}

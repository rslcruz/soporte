<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Cotizaciones_refacciones_sustituidas extends Model
{
    protected $primaryKey = 'id_cotizaciones_refacciones_sustituidas';
    protected $table = 'cotizaciones_refacciones_sustituidas';
	protected $fillable = [
	'cantidad',
	'serie',
	'destino',
	'anio',
	'id_soportes',
	'id_cotizaciones_refaccion'];


	protected $casts = [
	'id_cotizaciones_refacciones_sustituidas'   => 'integer',
	'cantidad'                                  => 'integer',
	'serie'                                     => 'string',
	'destino'                                   => 'string',
	'anio'                                      => 'date',
	'id_soportes'                               => 'integer',
	'id_cotizaciones_refaccion'                 => 'integer',
	
    ];

        public function soportes(){
		return $this->belongsTo('API\Soportes','id_soportes');
			}


	public function cotizacionesrefaccion(){
		return $this->belongsTo('API\Cotizaciones_refaccion','id_cotizaciones_refaccion');
			}

}

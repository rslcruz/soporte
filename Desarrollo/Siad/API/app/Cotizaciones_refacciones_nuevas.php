<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Cotizaciones_refacciones_nuevas extends Model
{
    protected $primaryKey = 'id_cotizaciones_refacciones_nuevas';
    protected $table = 'cotizaciones_refacciones_nuevas';
	protected $fillable = [
	'cantidad',
	'serie',
	'factura',
	'anio',
	'id_cotizaciones_proyectos_siad',
	'id_cotizaciones_refaccion',
	'id_soportes'];


	protected $casts = [
	'id_cotizaciones_refacciones_nuevas'      => 'integer',
	'cantidad'                                => 'integer',
	'serie'                                   => 'string',
	'factura'                                 => 'integer',
	'anio'                                    => 'date',
	'id_cotizaciones_proyectos_siad'          => 'integer',
	'id_cotizaciones_refaccion'               => 'integer',
	'id_soportes'                             => 'integer',	
    ];

        public function cotizacionesproyectossiad(){
		return $this->belongsTo('API\Cotizaciones_proyectos_siad','id_cotizaciones_proyectos_siad');
			}

       public function soportes(){
		return $this->belongsTo('API\Soportes','id_soportes');
			}


	public function cotizacionesrefaccion(){
		return $this->belongsTo('API\Cotizaciones_refaccion','id_cotizaciones_refaccion');
			}
}

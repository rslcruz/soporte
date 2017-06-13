<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Cotizaciones_tipo_refaccion extends Model
{
    protected $primaryKey = 'id_cotizaciones_tipo_refaccion';
	protected $table = 'cotizaciones_tipo_refaccion';
	protected $fillable = ['tipo_refaccion','id_cotizaciones_clasificacion_tipo_refaccion'];
	public $timestamps = false;

	 protected $casts = [
       'id_cotizaciones_tipo_refaccion'                   => 'integer',
       'tipo_refaccion'                                   => 'string'
       'id_cotizaciones_clasificacion_tipo_refaccion'     => 'integer',
       
       
       
    ];



	public function cotizacionesclasificaciontiporefaccion(){
		return $this->belongsTo('API\Cotizaciones_clasificacion_tipo_refaccion','id_cotizaciones_clasificacion_tipo_refaccion');
	}
}

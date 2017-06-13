<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Cotizaciones_modelo_refaccion  extends Model
{
    protected $primaryKey = 'id_cotizaciones_modelo_refaccion';
	protected $table = 'cotizaciones_modelo_refaccion';
	protected $fillable = [
	'modelo_refaccion',
	'num_parte',
	'id_cotizaciones_tipo_marca_refaccion'];
	public $timestamps = false;


	protected $casts = [   

				'id_cotizaciones_modelo_refaccion'      => 'integer',
				'modelo_refaccion'	                    => 'string',	
				'num_parte'                             => 'string',
				'id_cotizaciones_tipo_marca_refaccion'  => 'integer',
    ];

	public function cotizacionestipomarcarefaccion(){
		return $this->belongsTo('API\Cotizaciones_tipo_marca_refaccion','id_cotizaciones_tipo_marca_refaccion');
	}

}

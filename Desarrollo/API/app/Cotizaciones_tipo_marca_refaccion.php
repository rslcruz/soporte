<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Cotizaciones_tipo_marca_refaccion extends Model
{
    protected $primaryKey = 'id_cotizaciones_tipo_marca_refaccion';
	protected $table = 'cotizaciones_tipo_marca_refaccion';
	protected $fillable = ['id_cotizaciones_tipo_refaccion','id_cotizaciones_marca_refaccion'];
	public $timestamps = false;

	 protected $casts = [
       'id_cotizaciones_tipo_marca_refaccion'   => 'integer',
       'id_cotizaciones_tipo_refaccion'         => 'integer',
       'id_cotizaciones_marca_refaccion'        => 'integer',
       
       
       
    ];

	public function cotizacionesmarcarefaccion(){
		return $this->belongsTo('API\Cotizaciones_marca_refaccion','id_cotizaciones_marca_refaccion');
	}

	public function cotizacionestiporefaccion(){
		return $this->belongsTo('API\Cotizaciones_tipo_refaccion','id_cotizaciones_tipo_refaccion');
	}
}

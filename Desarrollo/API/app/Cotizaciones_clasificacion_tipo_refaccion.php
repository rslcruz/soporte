<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Cotizaciones_clasificacion_tipo_refaccion extends Model
{
    protected $primaryKey = 'id_cotizaciones_clasificacion_tipo_refaccion';
    protected $table = 'cotizaciones_clasificacion_tipo_refaccion';
    public $timestamps = false;
	protected $fillable = ['clasificacion_tipo_refaccion'];
	protected $casts = [
    'id_cotizaciones_clasificacion_tipo_refaccion'  => 'integer',
	'clasificacion_tipo_refaccion'    => 'string',
		
    ];

	
}



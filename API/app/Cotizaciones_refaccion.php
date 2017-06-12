<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Cotizaciones_refaccion extends Model
{
    protected $primaryKey = 'id_cotizaciones_refaccion';
    protected $table = 'cotizaciones_refaccion';
	protected $fillable = [
	'descripcion',
	'precio',
	'id_almequi_resguardante',
	'fecha_alta',
	'estatus',
	'id_cotizaciones_modelo_refaccion'];


	protected $casts = [
	'id_cotizaciones_refaccion'         => 'integer',
	'descripcion'                       => 'string' ,
	'precio'                            => 'double', 
	'id_almequi_resguardante'           => 'integer',
	'fecha_alta'                        => 'date',
	'estatus'                           => 'integer',
	'id_cotizaciones_modelo_refaccion'  => 'integer',
	
    ];

        public function cotizacionesmodelorefaccion(){
		return $this->belongsTo('API\Cotizaciones_modelo_refaccion','id_cotizaciones_modelo_refaccion');
			}

}

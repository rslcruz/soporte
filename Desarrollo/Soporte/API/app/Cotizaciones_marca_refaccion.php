<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Cotizaciones_marca_refaccion extends Model
{
    protected $primaryKey = 'id_cotizaciones_marca_refaccion';
	protected $table = 'cotizaciones_marca_refaccion';
	protected $fillable = ['marca_equipo'];   
	public $timestamps = false; 


	protected $casts = [   

				'id_cotizaciones_marca_refaccion' => 'integer',
				'marca_refaccion'	              => 'string',	
			
    ];


}

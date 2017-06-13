<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Cotizaciones_proyectos_siad extends Model
{
    protected $primaryKey = 'id_cotizaciones_proyectos_siad';
	protected $table = 'cotizaciones_proyectos_siad';
	protected $fillable = [
	'clave',
	'nombre'];   
	public $timestamps = false; 


	protected $casts = [ 
	'id_cotizaciones_proyectos_siad'   => 'integer',
    'clave'	                           => 'string',	
    'nombre'                           => 'string',			
    ];


}

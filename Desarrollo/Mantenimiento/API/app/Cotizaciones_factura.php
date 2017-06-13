<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Cotizaciones_factura extends Model
{
    protected $primaryKey = 'id_cotizaciones_factura';
	protected $table = 'cotizaciones_factura';
	protected $fillable = [
	'factura',
	'id_soportes'];   
	public $timestamps = false; 


	protected $casts = [ 
	'id_cotizaciones_factura'                             => 'integer',
    'id_soportes' => 'integer',	
			
    ];

    public function soportes(){
	return $this->hasOne('API\Soportes','id_soportes');
	}

}

<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Soportes_formato_salida_estatus extends Model
{
    protected $primaryKey = 'id_soportes_formato_salida_estatus';
    protected $table = 'soportes_formato_salida_estatus';
    public $timestamps = false;
	protected $fillable = ['estatus'];


	protected $casts = [   

				'id_soportes_formato_salida_estatus'  => 'integer',
				'estatus'               	          => 'string',	
			
    ];
}

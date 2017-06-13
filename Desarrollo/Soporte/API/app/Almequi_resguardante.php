<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Almequi_resguardante extends Model
{
	protected $primaryKey = 'id_almequi_resguardante';
    protected $table = 'almequi_resguardante';
    public $timestamps = false;
	protected $fillable = [
		'id_almequi_resguardante',
		'rfc',
		'curp',
		'nombre',			
		'apellido_paterno',
		'apellido_materno',
		'puesto',
		'fecha_ingreso',
		'extension',
		'email',
		'titulo',
		'nacionalidad',
		'id_almequi_subarea'
		'id_almequi_ubicacion',
		
		];
 

	protected $casts = [
        'id_almequi_resguardante'    => 'integer',
        'rfc'                        => 'string',
        'curp'                       => 'string',
		'nombre'                     => 'string',	
		'apellido_paterno'           => 'string',
		'apellido_materno'           => 'string',
		'puesto'                     => 'string',
		'extension'                  => 'string',
		'email'                      => 'string',
		'titulo'                     => 'string',
		'nacionalidad'               => 'string',
		'id_almequi_subarea'         => 'integer',
		'id_almequi_ubicacion'       => 'integer',
    ];
		
	public function almequisubarea(){
		return $this->belongsTo('API\Almequi_subarea','id_almequi_subarea');
	}
	public function almequiubicacion(){
		return $this->belongsTo('API\Almequi_ubicacion','id_almequi_ubicacion');
	}
}

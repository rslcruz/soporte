<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Resguardante extends Model
{
	protected $primaryKey = 'id_resguardante';
    protected $table = 'resguardante';
    public $timestamps = false;
	protected $fillable = [
		'id_resguardante',
		'nombre',
		'rfc',
		'curp',
		'apellido_paterno',
		'apellido_materno',
		'puesto',
		'fecha_ingreso',
		'extension',
		'email',
		'titulo',
		'nacionalidad',
		'ubicacion_id',
		'subarea_id'
		];


	protected $casts = [
        'id_resguardante'    => 'integer',
		'nombre'             => 'string',
		'rfc'                => 'string',
		'curp'               => 'string',
		'apellido_paterno'   => 'string',
		'apellido_materno'   => 'string',
		'puesto'             => 'string',
		'fecha_ingreso'      => 'datetime',
		'extension'          => 'string',
		'email'              => 'string',
		'titulo'             => 'string',
		'nacionalidad'       => 'string',
		'ubicacion_id'       => 'integer',
		'subarea_id'         => 'integer',
    ];
		
	public function subarea(){
		return $this->belongsTo('API\Subarea');
	}
	public function ubicacion(){
		return $this->belongsTo('API\Ubicacion','ubicacion_id');
	}
}

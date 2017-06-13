<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Almequi_usuario extends Model
{
    protected $primaryKey = 'id_almequi_usuario';
    protected $table = 'almequi_usuario';
    public $timestamps = false;
	protected $fillable = [
		'id_almequi_usuario',
		'nombre',
		'apellido_paterno',
		'apellido_materno',
		'correo',
		'extension',
		'puesto',
		'periodo_uso',
		'id_almequi_subarea',
		'id_almequi_ubicacion'
		];




		 protected $casts = [
       
		'id_almequi_usuario'          => 'integer',
		'nombre'			          => 'string',
		'apellido_paterno'            => 'string',
		'apellido_materno'            => 'string',
		'correo'                      => 'string',
		'extension'                   => 'string',
		'puesto'                      => 'string',
		'periodo_uso'                 => 'string', 
		'id_almequi_subarea'          => 'integer',
		'id_almequi_ubicacion'        => 'integer',

       
       
       
    ];
	public function almequisubarea(){
		return $this->belongsTo('API\Almequi_subarea');
	}
	public function almequiubicacion(){
		return $this->belongsTo('API\Almequi_ubicacion','id_almequi_ubicacion');
	}
}
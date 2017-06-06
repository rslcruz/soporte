<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class UsuarioEquipo extends Model
{
    protected $primaryKey = 'id_usuario_equipo';
    protected $table = 'usuario_equipo';
    public $timestamps = false;
	protected $fillable = [
		'id_usuario_equipo',
		'nombre',
		'apellido_paterno',
		'apellido_materno',
		'correo',
		'extension',
		'puesto',
		'periodo_uso',
		'subarea_id',
		'ubicacion_id'
		];




		 protected $casts = [
       
		'id_usuario_equipo'   => 'integer',
		'nombre'			  => 'string',
		'apellido_paterno'    => 'string',
		'apellido_materno'    => 'string',
		'correo'              => 'string',
		'extension'           => 'string',
		'puesto'              => 'string',
		'periodo_uso'         => 'string', 
		'subarea_id'          => 'integer',
		'ubicacion_id'        => 'integer',

       
       
       
    ];
	public function subarea(){
		return $this->belongsTo('API\Subarea');
	}
	public function ubicacion(){
		return $this->belongsTo('API\Ubicacion','ubicacion_id');
	}
}
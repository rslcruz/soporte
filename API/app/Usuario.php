<?php

namespace API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Usuario_perfil;

//use Illuminate\Auth\UserTrait;
//use Illuminate\Auth\UserInterface;
//use Illuminate\Auth\Reminders\RemindableTrait;
//use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;


class Usuario extends Model implements AuthenticatableContract 
{
	//use UserTrait;
    //use RemindableTrait;
	use Authenticatable;
    use SoftDeletes;

	protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
	protected $fillable = ['nombre',
	'apellido_paterno',
	'apellido_materno',
	'puesto',
	'password',
	'id_usuario_perfil',
	'id_usuario_empresa',
	'nombre_usuario',
	'correo',
	'activo',
    'carga_trabajo'];

	protected $dates = ['deleted_at'];
	protected $hidden = ['password', 'remember_token'];

	protected $casts = [
		'id_usuario'            => 'integer',
		'nombre'                => 'string',
		'apellido_paterno'      => 'string',
		'apellido_materno'      => 'string',
		'puesto'                => 'string',
		'password'              => 'string',
		'id_usuario_perfil'     => 'integer',
		'id_usuario_empresa'    => 'integer',
		'nombre_usuario'        => 'string',
		'correo'                => 'string',
		'activo'                => 'integer',
		'carga_trabajo'         => 'integer',
        
    ];

	public function usuarioperfil(){
		return $this->belongsTo('API\Usuario_perfil','id_usuario_perfil');
	}
	public function usuarioempresa(){
		return $this->belongsTo('API\Usuario_empresa','id_usuario_empresa');
	}
}

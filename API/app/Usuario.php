<?php

namespace API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Perfil;

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

    protected $primaryKey = 'id_usuario';
	protected $table = 'usuario';
	protected $fillable = ['nombre','password','perfil_id','nombre_usuario','correo','empresa_id','activo','carga_trabajo'];
	protected $dates = ['deleted_at'];
	protected $hidden = ['password', 'remember_token'];

	protected $casts = [
		'id_usuario'     => 'integer',
		'nombre'         => 'string',    
		'password'       => 'string',
		'perfil_id'      => 'integer',
		'nombre_usuario' => 'string',
		'correo'         => 'string',
		'empresa_id'     => 'integer',
		'activo'         => 'integer',
		'carga_trabajo'  => 'integer',
        
    ];

	public function perfil(){
		return $this->belongsTo('API\Perfil','perfil_id');
	}
	public function empresa(){
		return $this->belongsTo('API\Empresa','empresa_id');
	}
}

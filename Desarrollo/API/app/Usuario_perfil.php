<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Usuario_perfil extends Model
{
	protected $primaryKey = 'id_usuario_perfil';
    protected $table = 'usuario_perfil';
	protected $fillable = ['perfil'];
	public $timestamps = false;

	protected $casts = [
        'id_usuario_perfil' => 'integer',
        'perfil'            => 'string',
    ];

	public function usuario(){
		return $this->hasMany('API\Usuario');
	}
}

<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
	protected $primaryKey = 'id_perfil';
    protected $table = 'perfil';
	protected $fillable = ['perfil'];
	public $timestamps = false;

	protected $casts = [
        'id_perfil' => 'integer',
        'perfil'    => 'string',
    ];

	public function usuarios(){
		return $this->hasMany('API\Usuario');
	}
}

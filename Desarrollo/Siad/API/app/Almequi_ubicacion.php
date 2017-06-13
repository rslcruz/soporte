<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Almequi_ubicacion extends Model
{
    protected $primaryKey = 'id_almequi_ubicacion';
    protected $table = 'almequi_ubicacion';
	protected $fillable = ['id_almequi_ubicacion','edificio','piso'];
	public $timestamps = false;


	 protected $casts = [
       'id_almequi_ubicacion'   => 'integer',
       'edificio'               => 'string',
       'piso'                   => 'string',
       
       
       
    ];

public function almequiusuario(){
		return $this->hasMany('API\Almequi_usuario');
	}
    
    public function almequiresguardante(){
		return $this->hasMany('API\Almequi_resguardante');
	}
    
}
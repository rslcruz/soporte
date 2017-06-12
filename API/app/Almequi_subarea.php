<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Almequi_subarea extends Model
{
	protected $primaryKey = 'id_almequi_subarea';
    protected $table = 'almequi_subarea';
	protected $fillable = ['subarea','id_almequi_area'];
	public $timestamps = false;


	 protected $casts = [
       'id_subarea'          => 'integer',
       'subarea'             => 'string',
       'id_almequi_area'     => 'integer'
       
       
    ];



	public function almequiarea(){
		return $this->belongsTo('API\Almequi_area');
	}

	public function almequiresguardante(){
		return $this->hasMany('API\Almequi_resguardante');
	}

	public function almequiusuario(){
		return $this->hasMany('API\Almequi_usuario');
	}
}

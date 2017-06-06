<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Subarea extends Model
{
	protected $primaryKey = 'id_subarea';
    protected $table = 'subarea';
	protected $fillable = ['subarea'];
	public $timestamps = false;


	 protected $casts = [
       'id_subarea'    => 'integer',
       'subarea'       => 'string',
       
       
    ];



	public function area(){
		return $this->belongsTo('API\Area');
	}

	public function resguardantes(){
		return $this->hasMany('API\Resguardante');
	}

	public function usuarios(){
		return $this->hasMany('API\UsuarioEquipo');
	}
}

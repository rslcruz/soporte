<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Base_tipo_reparacion extends Model
{
    protected $primaryKey = 'id_base_tipo_reparacion';
	protected $table = 'base_tipo_reparacion';
	protected $fillable = ['tipo_reparacion'];
	public $timestamps = false;

	 protected $casts = [
       'id_base_tipo_reparacion'    => 'integer',
       'tipo_reparacion'            => 'string',
       
       
       
    ];



	public function baseclasificacionReparacion(){
		return $this->hasMany('API\Base_clasificacion_reparacion');
	}
}


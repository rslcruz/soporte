<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Base_clasificacion_reparacion extends Model
{
    protected $primaryKey = 'id_base_clasificacion_reparacion';
	protected $table = 'base_clasificacion_reparacion';
	protected $fillable = ['clasificacion_reparacion',
	'id_base_tipo_reparacion',
	'tipo_clas'];

	public $timestamps = false;

	 protected $casts = [
       'id_base_clasificacion_reparacion'    => 'integer',
       'clasificacion_reparacion'            => 'string',
       'id_base_tipo_reparacion'             => 'integer',
       'tipo_clas'                           => 'integer',
       
       
       
    ];



	public function basetiporeparacion(){
		return $this->belongsTo('API\Base_tipo_reparacion','id_base_tipo_reparacion');
	}

	public function basesubclasificacionreparacion(){
		return $this->hasMany('API\Base_subclasificacion_reparacion');
	}
}


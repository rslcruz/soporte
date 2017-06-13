<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Base_subclasificacion_reparacion extends Model
{
    protected $primaryKey = 'id_base_subclasificacion_reparacion';
	protected $table = 'base_subclasificacion_reparacion';
	protected $fillable = ['subclasificacion_reparacion','id_base_clasificacion_reparacion','tipo_sub'];
	public $timestamps = false;


	 protected $casts = [
        'id_base_subclasificacion_reparacion'  => 'integer',
        'subclasificacion_reparacion'          => 'string',
        'id_base_clasificacion_reparacion'     => 'integer',
        'tipo_sub'                             => 'integer',
    ];

	 
	public function baseclasificacionreparacion(){
		return $this->belongsTo('API\Base_clasificacion_reparacion','id_base_clasificacion_reparacion');
	}

	public function basesolucion(){
		return $this->belongsTo('API\Base_solucion');
	}

}





<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Clasificacion_reparacion extends Model
{
    

    protected $primaryKey = 'id_clasificacion_reparacion';
	protected $table = 'clasificacion_reparacion';
	protected $fillable = ['id_clasificacion_reparacion','clasificacion_reparacion','tipo_reparacion_id','tipo_clas'];
	public $timestamps = false;

	 protected $casts = [
        'id_clasificacion_reparacion' => 'integer',
        'clasificacion_reparacion'    => 'string',
        'tipo_reparacion_id'          => 'integer',
        'tipo_clas'                   => 'integer',
    ];

	public function tipoReparacion(){
		return $this->belongsTo('API\Tipo_reparacion');
	}


	public function subclasificacionReparacion(){
		return $this->hasMany('API\subclasificacion_reparacion');
	}
}
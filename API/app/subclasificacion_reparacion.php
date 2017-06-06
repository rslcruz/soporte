<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class subclasificacion_reparacion extends Model
{
    protected $primaryKey = 'id_subclasificacion_reparacion';
	protected $table = 'subclasificacion_reparacion';
	protected $fillable = ['id_subclasificacion_reparacion','subclasificacion_reparacion','clasificacion_reparacion_id','tipo_sub'];
	public $timestamps = false;


	 protected $casts = [
        'id_subclasificacion_reparacion' => 'integer',
        'subclasificacion_reparacion'    => 'string',
        'clasificacion_reparacion_id'    => 'integer',
        'tipo_sub'                       => 'integer',
    ];

	 
	public function clasificacionReparacion(){
		return $this->belongsTo('API\Clasificacion_reparacion');
	}


}





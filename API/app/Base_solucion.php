<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Base_solucion extends Model
{
    protected $primaryKey = 'id_base_solucion';
    protected $table = 'base_solucion';
    public $timestamps = false;
	protected $fillable = ['falla',
	'id_base_servicio_solicitado',
	'id_base_subclasificacion_reparacion',
	'solucion'];



	 protected $casts = [
       
		'id_base_solucion'                       => 'integer',
		'falla'	                                 => 'string',
		'id_base_servicio_solicitado'            => 'integer',
		'id_base_subclasificacion_reparacion'    => 'integer',
		'solucion'                               => 'string',
	       
    ];

	public function basesubclasificacionreparacion(){
		return $this->hasMany('API\Base_subclasificacion_reparacion','id_base_subclasificacion_reparacion');
	}
	public function baseserviciosolicitado(){
		return $this->hasMany('API\Base_servicio_solicitado','id_base_servicio_solicitado');
	}
}

<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Tipo_reparacion extends Model
{
    protected $primaryKey = 'id_tipo_reparacion';
	protected $table = 'tipo_reparacion';
	protected $fillable = ['id_tipo_reparacion','tipo_reparacion'];
	public $timestamps = false;

	 protected $casts = [
       'id_tipo_reparacion'    => 'integer',
       'tipo_reparacion'       => 'string',
       
       
       
    ];



	public function clasificacionReparacion(){
		return $this->hasMany('API\clasificacion_reparacion');
	}
}


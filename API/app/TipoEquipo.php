<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class TipoEquipo extends Model
{
    protected $primaryKey = 'id_tipo_equipo';
	protected $table = 'tipo_equipo';
	protected $fillable = ['tipo_equipo','clasificacion_tipo_equipo_id'];
	public $timestamps = false;

	 protected $casts = [
       'id_tipo_equipo'                   => 'integer',
       'clasificacion_tipo_equipo_id'     => 'integer',
       
       
       
    ];



	public function clasificacionTipoEquipo(){
		return $this->belongsTo('API\ClasificacionTipoEquipo');
	}
}

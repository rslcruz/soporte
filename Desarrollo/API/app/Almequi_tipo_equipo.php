<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Almequi_tipo_equipo extends Model
{
	protected $primaryKey = 'id_almequi_tipo_equipo';
    protected $table = 'almequi_tipo_equipo';
    public $timestamps = false;
	protected $fillable = [
				'tipo_equipo',
				'id_almequi_clasificacion_tipo_equipo'				
				];

	protected $casts = [   

				'id_almequi_tipo_equipo'                    => 'integer',
				'tipo_equipo'								=> 'string',
				'id_almequi_clasificacion_tipo_equipo'      => 'integer',
				


    ];

	public function almequiclasificaciontipoequipo(){
		return $this->belongsTo('API\Almequi_clasificacion_tipo_equipo','id_almequi_clasificacion_tipo_equipo');
	}

	
    
}

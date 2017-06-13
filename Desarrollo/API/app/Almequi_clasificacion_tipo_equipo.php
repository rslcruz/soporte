<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Almequi_clasificacion_tipo_equipo extends Model
{
    protected $primaryKey = 'id_almequi_clasificacion_tipo_equipo';
    protected $table = 'almequi_clasificacion_tipo_equipo';
	protected $fillable = ['clasificacion_tipo_equipo'];


	protected $casts = [   

				'id_almequi_clasificacion_tipo_equipo' => 'integer',
				'clasificacion_tipo_equipo'	 => 'string',					

    ];

}

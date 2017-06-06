<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class ClasificacionTipoEquipo extends Model
{
	protected $table = 'clasificacion_tipo_equipo';
    protected $primaryKey = 'id_clasificacion_tipo_equipo';
	protected $fillable = ['clasificacion_tipo_equipo'];
	public $timestamps = false;

	protected $casts = [
        'id_clasificacion_tipo_equipo' => 'integer',
        'clasificacion_tipo_equipo'    => 'string',
    ];
}

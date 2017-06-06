<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Nivel_servicios extends Model
{
    protected $primaryKey = 'id_nivel_servicio';
    protected $table = 'nivel_servicio';
	protected $fillable = ['nivel_servicio','tiempo','fecha_inicio','fecha_fin','id_empresa'];


	protected $casts = [   

				'id_nivel_servicio' => 'integer',
				'nivel_servicio'    => 'string',
				'id_empresa'	    => 'integer',					

    ];

  //       public function solicitudes(){
		// return $this->hasMany('API\Solicitud');
		// 	}

}

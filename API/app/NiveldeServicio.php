<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class NiveldeServicio extends Model
{
    protected $primaryKey = 'id_nivel_servicio';
    protected $table = 'nivel_servicios';
	protected $fillable = ['nivel_servicio'];


	protected $casts = [   

				'id_nivel_servicio' => 'integer',
				'nivel_servicio'	 => 'string',					

    ];

  //       public function solicitudes(){
		// return $this->hasMany('API\Solicitud');
		// 	}

}

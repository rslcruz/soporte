<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Soportes_tipo_soporte extends Model
{
    protected $primaryKey = 'id_soportes_tipo_soporte';
    protected $table = 'soportes_tipo_soporte';
	protected $fillable = ['tipo_soporte','id_soportes_nivel_servicio'];


	protected $casts = [   

				'id_soportes_tipo_soporte'     => 'integer',
				'tipo_soporte'                 => 'string',
				'id_soportes_nivel_servicio'   => 'integer',					

    ];

        public function soportesnivelservicio(){
		return $this->belongTo('API\Soportes_nivel_servicio','id_soportes_nivel_servicio');
			}

}

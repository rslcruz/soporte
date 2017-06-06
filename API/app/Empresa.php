<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $primaryKey = 'id_empresa';
    protected $table = 'empresa';
    public $timestamps = false;
	protected $fillable = ['id_empresa','empresa'];

	protected $casts = [   

				'id_empresa' => 'integer',
				'empresa'	 => 'string',					

    ];

      public function NivelServicios(){
		 return $this->hasMany('API\Nivel_servicios','id_empresa');
		 	}


}

<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Base_servicio_solicitado extends Model
{
    protected $primaryKey = 'id_base_servicio_solicitado';
    protected $table = 'base_servicio_solicitado';
	protected $fillable = ['servicio_solicitado','carga_trabajo'];
	public $timestamps = false;

	protected $casts = [
		'id_base_servicio_solicitado' => 'integer',
      	'servicio_solicitado'         => 'string',
		'carga_trabajo'               => 'integer',

    ];


    public function basesolucion(){
		return $this->belongsTo('API\Base_solucion');
	}

}

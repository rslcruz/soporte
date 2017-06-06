<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class ServicioSolicitado extends Model
{
    protected $primaryKey = 'id_servicio_solicitado';
    protected $table = 'servicio_solicitado';
	protected $fillable = ['servicio_solicitado'];
	public $timestamps = false;

	protected $casts = [
        'id_servicio_solicitado'    => 'integer',
		'servicio_solicitado'       => 'string',
		
    ];
}

<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class EstatusSolicitud extends Model
{
    protected $primaryKey = 'id_estatus_solicitud';
    protected $table = 'estatus_solicitud';
	protected $fillable = ['estatus'];


	protected $casts = [   

				'id_estatus_solicitud' => 'integer',
				'estatus'	 => 'string',					

    ];

}

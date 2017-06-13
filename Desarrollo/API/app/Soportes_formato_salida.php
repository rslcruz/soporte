<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Soportes_formato_salida extends Model
{
    protected $primaryKey = 'id_soportes_formato_salida';
    protected $table = 'soportes_formato_salida';
    public $timestamps = false;
	protected $fillable = [
	'se_autoriza_a',
	'salida_del_edificio',
	'destino',
	'motivo_salida',
	'fuera_instituto',
	'observaciones',
	'fecha_regreso',
	'rev_sal_fecha',
	'rev_sal_nombre',
	'rev_reg_fecha',
	'rev_reg_nombre',
	'aut_cargo',
	'aut_nombre',
	'id_soportes',
	'id_soportes_formato_salida_estatus'];


	protected $casts = [   

	'id_soportes_formato_salida'         => 'integer'
 	'se_autoriza_a'                      => 'string',
	'salida_del_edificio'                => 'string',
	'destino'                            => 'string',
	'motivo_salida'                      => 'string',
	'fuera_instituto'                    => 'string',
	'observaciones'                      => 'string',
	'fecha_regreso'                      => 'string',
	'rev_sal_fecha'                      => 'string',
	'rev_sal_nombre'                     => 'string',
	'rev_reg_fecha'                      => 'string',
	'rev_reg_nombre'                     => 'string',
	'aut_cargo'                          => 'string',
	'aut_nombre'                         => 'string',
	'id_soportes'                        => 'integer',
	'id_soportes_formato_salida_estatus' => 'integer',

    ];


    	public function soportes(){
		return $this->hasOne('API\Soportes','id_soportes');
	}

		public function soportesformatosalidaestatus(){
		return $this->belongsTo('API\Soportes_formato_salida_estatus','id_soportes_formato_salida_estatus');
	}


}

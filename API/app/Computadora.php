<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Computadora extends Model
{
	protected $primaryKey = 'id_computadora';
    protected $table = 'computadora';
    public $timestamps = false;
	protected $fillable = [
				'id_computadora',
				'ip',
				'mac_address',
				'sistema_operativo_version_id',
				'antivirus_id',
				'accesorios',
				'cambio_nombre_equipo',
				'ingreso_a_dominio',
				'ocs_inventory',
				'nombre_usuario_dominio',
				'version_office',
				'observaciones',
				'red_cableada_id'
				];

	protected $casts = [   

				'id_computadora'                    => 'integer',
				'ip'								=> 'string',
				'mac_address'						=> 'string',
				'sistema_operativo_version_id'      => 'integer',
				'antivirus_id'                      => 'integer',
				'accesorios'                        => 'string',
				'cambio_nombre_equipo'              => 'string',
				'ingreso_a_dominio'                 => 'integer',
				'ocs_inventory'						=> 'integer',
				'nombre_usuario_dominio'      		=> 'string',
				'version_office'                    => 'string',
				'observaciones'                     => 'string',
				'red_cableada_id'					=> 'integer',


    ];

	public function antivirus(){
		return $this->belongsTo('API\Antivirus','antivirus_id');
	}

	public function versionSistemaOperativo(){
		return $this->belongsTo('API\VersionSistemaOperativo','sistema_operativo_version_id');
	}

	public function redCableada(){
		return $this->belongsTo('API\RedCableada','red_cableada_id');
	}
    
}

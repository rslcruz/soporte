<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Almequi_inventario extends Model
{
	protected $primaryKey = 'id_almequi_inventario';
	public $incrementing = false;
	protected $table = 'almequi_inventario';
	public $timestamps = false;
	protected $fillable = ['id_almequi_inventario','nombre_equipo','serie','activo','id_almequi_resguardante','id_almequi_modelo_equipo','id_almequi_usuario','id_almequi_ubicacion','fecha_alta','responsiva_firmada'];



	protected $casts = [   

				'id_almequi_inventario'      => 'integer',
				'nombre_equipo'	             => 'string',	
				'serie'					     => 'string',
				'activo'			         => 'integer',
				'id_almequi_resguardante'    => 'integer',
				'id_almequi_modelo_equipo'   => 'integer',
				'id_almequi_usuario'         => 'integer',
				'id_almequi_ubicacion'       => 'integer',
			    'responsiva_firmada'	     => 'integer',


    ];




	public function almequiresguardante(){
		return $this->belongsTo('API\Almequi_resguardante','id_almequi_resguardante');
	}

	public function almequiusuario(){
		return $this->belongsTo('API\Almequi_usuario','id_almequi_usuario');
	}
	public function almequimodelo(){
		return $this->belongsTo('API\Almequi_modelo_equipo','id_almequi_modelo_equipo');
	}	
	 
	public function almequiubicacion(){
		return $this->belongsTo('API\Almequi_ubicacion','id_almequi_ubicacion');
	}

	public function almequiestatusseguimiento(){
		return $this->hasMany('API\Almequi_estatus_seguimiento');
	}


	// public function solicitud(){
	// 	return $this->hasMany('API\Solicitud','id_inventario');


	// }
}

<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
	protected $primaryKey = 'id_inventario';
	public $incrementing = false;
	protected $table = 'inventario';
	public $timestamps = false;
	protected $fillable = ['id_inventario','nombre_equipo','descripcion','serie','activo','resguardante_id','modelo_equipo_id','encargado_id','computadora_id','ubicacion_id','switch_id', 'fecha_alta','responsiva_firmada'];



	// ['id_inventario','nombre_equipo','descripcion','serie','activo',
	// 'resguardante_id','modelo_equipo_id','encargado_id','computadora_id','ubicacion_id','switch_id'];


	// protected $casts = [   

	// 			'id_inventario'  => 'integer',
	// 			'nombre_equipo'	    => 'string',					
	// 			'descripcion'	    => 'string',	
	// 			'serie'        => 'string',
	// 			'activo'        => 'integer',
	// 			'resguardante_id'         => 'integer',
	// 			'modelo_equipo_id'           => 'integer',
	// 			'encargado_id'         => 'integer',
	// 			'computadora_id'  => 'integer',
	// 			'ubicacion_id'   => 'integer'
	// 			'switch_id'         => 'integer',
	// 			'fecha_alta'=> 'date',
				
	// 			'responsiva_firmada'            => 'integer',		

 //    ];


	protected $casts = [   

				'id_inventario'            => 'string',
				'nombre_equipo'	           => 'string',	
				'descripcion'              => 'string',
				'serie'					   => 'string',
				'activo'			       => 'integer',
				'resguardante_id'          => 'integer',
				'modelo_equipo_id'         => 'integer',
				'encargado_id'             => 'integer',
				'computadora_id'           => 'integer',
				'ubicacion_id'			   => 'integer',
				'switch_id'                => 'integer',
			    //'fecha_alta'               => 'date',
			    'responsiva_firmada'	   => 'integer',


    ];




	public function resguardante(){
		return $this->belongsTo('API\Resguardante','resguardante_id');
	}

	public function encargado(){
		return $this->belongsTo('API\UsuarioEquipo','encargado_id');
	}
	public function modelo(){
		return $this->belongsTo('API\ModeloEquipo','modelo_equipo_id');
	}
	public function computadora(){
		return $this->belongsTo('API\Computadora','computadora_id');
	}
	 public function switchss(){
	 	return $this->belongsTo('API\Switche','switch_id');
	 }
	public function ubicacion(){
		return $this->belongsTo('API\Ubicacion','ubicacion_id');
	}

	// public function solicitud(){
	// 	return $this->hasMany('API\Solicitud','id_inventario');


	// }
}

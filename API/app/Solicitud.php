<?php

namespace API; 

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
	protected $primaryKey = 'id_solicitud_soporte';
    protected $table = 'solicitud_soporte';
    public $timestamps = false;
    protected $fillable = [
    'falla_reportada','usuario_atendido','fecha_apertura','fecha_atencion','fecha_reparacion','observaciones','diagnostico','tipo_atencion',
    'estatus_solicitud_id','inventario_id','servicio_solicitado_id','tecnico_id','usuario_id','subclasificacion_reparacion_id'
    ]; 




    protected $casts = [   

				'id_solicitud_soporte'  => 'integer',
				'falla_reportada'	    => 'string',					
				'usuario_atendido'	    => 'string',	
				// 'fecha_apertura'        => 'datetime',
				// 'fecha_atencion'        => 'datetime',
				'observaciones'         => 'string',
				'diagnostico'           => 'string',
				'tipo_atencion'         => 'string',
				'estatus_solicitud_id'  => 'integer',
				'inventario_id'         => 'string',
				'servicio_solicitado_id'=> 'integer',
				'tecnico_id'            => 'integer',
				'usuario_id'            => 'integer',					
				'subclasificacion_reparacion_id' => 'integer',	
				

    ];


    public function inventario(){
		return $this->belongsTo('API\Inventario');
	}

	public function servicioSolicitado(){
		return $this->belongsTo('API\ServicioSolicitado');
	}
       
	public function estatusSolicitud(){
		return $this->belongsTo('API\EstatusSolicitud');
		
	}       
	

	public function usuario(){
		return $this->belongsTo('API\Usuario');
	}

	public function tecnico(){
		return $this->belongsTo('API\Usuario');
	}
// agregado desde aqui
	
	public function subclasificacionReparacion(){
		return $this->belongsTo('API\subclasificacion_reparacion');
	}

	



}
 
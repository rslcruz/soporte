<?php

namespace API; 

use Illuminate\Database\Eloquent\Model;

class Soportes extends Model
{
	protected $primaryKey = 'id_soportes';
    protected $table = 'soportes';
    public $timestamps = false;
    protected $fillable = [
    'id_almequi_inventario',
    'falla_reportada',
    'id_base_servicio_solicitado',
    'fecha_apertura',
    'fecha_atencion',
    'fecha_reparacion',
    'fecha_cierre',
    'observaciones',
    'diagnostico',
    'tipo_atencion',
    'usuario_atendido',
    'id_usuario',
    'id_soportes_tecnico',
    'id_base_subclasificacion_reparacion',
    'id_soportes_tipo_soporte',
    'evaluacion_atencion',
    'evaluacion_desempeño_tecnico',
    'id_soportes_estatus_catalogo'
    ]; 




    protected $casts = [   
                'id_soportes         '                 => 'integer',
				'id_almequi_inventario'                => 'integer',
				'falla_reportada'	                   => 'string',
				'id_base_servicio_solicitado'          => 'integer',
				'observaciones'                        => 'string',
				'diagnostico'                          => 'string',
				'tipo_atencion'                        => 'string',
				'usuario_atendido'                     => 'string',
				'id_usuario'                           => 'integer',
				'id_soportes_tecnico'                  => 'integer',
				'id_base_subclasificacion_reparacion', => 'integer',
                'id_soportes_tipo_soporte',            => 'integer', 
                'evaluacion_atencion',                 => 'integer',
                'evaluacion_desempeño_tecnico'         => 'integer',
                'id_soportes_estatus_catalogo'         => 'integer', 
                


				
				
				
			
				

    ];


    public function almequiinventario(){
	return $this->belongsTo('API\Almequi_inventario','id_almequi_inventario');
	}

	public function baseserviciosolicitado(){
	return $this->belongsTo('API\Base_servicio_solicitado');
	}

	public function usuario(){
	return $this->belongsTo('API\Usuario','id_usuario');
	}

	public function soportestecnico(){
		return $this->belongsTo('API\Soportes_tecnico','id_soportes_tecnico');
	}
// agregado desde aqui
	
	public function basesubclasificacionreparacion(){
		return $this->belongsTo('API\Base_subclasificacion_reparacion','id_base_subclasificacion_reparacion');
	}

	public function soportestiposoporte(){
		return $this->belongsTo('API\Soportes_tipo_soporte','id_soportes_tipo_soporte');
		
	}       
	
    public function soportesestatuscatalogo(){
	return $this->belongsTo('API\Soportes_estatus_catalogo','id_soportes_estatus_catalogo');
		
	}  

   public function cotizacionesrefaccionessustituidas(){
	return $this->hasMany('API\Cotizaciones_refacciones_sustituidas');
		
	} 

	 public function cotizacionesrefaccionesnuevas(){
	return $this->hasMany('API\Cotizaciones_refacciones_nuevas');
		
	} 
	 public function cotizaciones(){
	return $this->hasMany('API\Cotizaciones');
		
	} 

	 public function soportesformatosalida(){
	return $this->belongsTo('API\Soportes_formato_salida');
		
	}
	 public function soportesfotos(){
	return $this->hasMany('API\Soportes_fotos');
		
	}
	public function cotizacionesfactura(){
	return $this->belongsTo('API\Cotizaciones_factura');
		
	}

}
 
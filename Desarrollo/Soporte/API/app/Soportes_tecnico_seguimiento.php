<?php

namespace API; 

use Illuminate\Database\Eloquent\Model;

class Soportes_tecnico_seguimiento extends Model
{
	protected $primaryKey = 'id_soportes_tecnico_seguimiento';
    protected $table = 'soportes_tecnico_seguimiento';
    public $timestamps = false;
    protected $fillable = [
    'fecha',
    'activo',
    'id_soportes_tecnico',
    'id_soportes'
    ]; 




    protected $casts = [   
                'id_soportes_tecnico_seguimiento'   => 'integer',
				'activo'                            => 'integer',
				'id_soportes_tecnico'	            => 'integer',
				'id_soportes'                       => 'integer',
				
			
				
				
				
			
				

    ];


    public function soportestecnico(){
		return $this->belongsTo('API\Soportes_tecnico','id_soportes_tecnico');
	}

	public function soportes(){
		return $this->belongsTo('API\Soportes','id_soportes');
	}
       
	
	



}
 
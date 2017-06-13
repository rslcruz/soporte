<?php

namespace API; 

use Illuminate\Database\Eloquent\Model;

class Soportes_formato_salida_pdf extends Model
{
	protected $primaryKey = 'id_soportes_formato_salida_pdf';
    protected $table = 'soportes_formato_salida_pdf';
    public $timestamps = false;
    protected $fillable = [
    'formato_salida',
    'id_soportes'    
    ]; 




    protected $casts = [   
                'id_soportes_formato_salida_pdf '   => 'integer',
				'id_soportes'	                    => 'integer',				
				];


    public function soportes(){
		return $this->belongsTo('API\Soportes','id_soportes');
	}

	



}
 
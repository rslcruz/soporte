<?php

namespace API; 

use Illuminate\Database\Eloquent\Model;

class Soportes_fotos extends Model
{
	protected $primaryKey = 'id_soportes_fotos';
    protected $table = 'soportes_fotos';
    public $timestamps = false;
    protected $fillable = [
    'nombre_foto',
    'foto',
    'id_soportes'    
    ]; 




    protected $casts = [   
                'id_soportes_fotos '      => 'integer',
				'nombre_foto'             => 'string',
				'id_soportes'	          => 'integer',	
				];


    public function soportes(){
		return $this->belongsTo('API\Soportes','id_soportes');
	}

	

	



}
 
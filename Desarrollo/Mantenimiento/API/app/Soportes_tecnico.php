<?php

namespace API; 

use Illuminate\Database\Eloquent\Model;

class Soportes_tecnico extends Model
{
	protected $primaryKey = 'id_soportes_tecnico';
    protected $table = 'soportes_tecnico';
    public $timestamps = false;
    protected $fillable = [
    'nombre',
    'apellido_paterno',
    'apellido_materno',
    'estatus'
    ]; 




    protected $casts = [   
                'id_soportes_tecnico'   => 'integer',
				'nombre'                => 'string',
				'apellido_paterno'	    => 'string',
				'apellido_materno'      => 'string',
				'estatus'               => 'integer',
			
				
				
				
			
				

    ];


   


}
 
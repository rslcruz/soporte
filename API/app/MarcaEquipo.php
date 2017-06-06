<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class MarcaEquipo extends Model
{
    protected $primaryKey = 'id_marca_equipo';
	protected $table = 'marca_equipo';
	protected $fillable = ['marca_equipo'];   
	public $timestamps = false; 


	protected $casts = [   

				'id_marca_equipo' => 'integer',
				'marca_equipo'	  => 'string',	
			
    ];




}

<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class MarcaSistemaOperativo extends Model
{
    protected $primaryKey = 'id_marca_sistema_operativo';
    protected $table = 'marca_sistema_operativo';
    public $timestamps = false;
	protected $fillable = ['id_marca_sistema_operativo','marca_sistema_operativo'];


	protected $casts = [   

				'id_marca_sistema_operativo'  => 'integer',
				'marca_sistema_operativo'	  => 'string',	
			
    ];
}

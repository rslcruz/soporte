<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class ModeloEquipo extends Model
{
    protected $primaryKey = 'id_modelo_equipo';
	protected $table = 'modelo_equipo';
	protected $fillable = ['modelo_equipo','tipo_marca_equipo_id'];
	public $timestamps = false;

	protected $casts = [   

				'id_modelo_equipo'      => 'integer',
				'modelo_equipo'	        => 'string',	
				'tipo_marca_equipo_id'  => 'integer',
    ];

	public function tipoMarcaEquipo(){
		return $this->belongsTo('API\TipoMarcaEquipo','tipo_marca_equipo_id');
	}

}

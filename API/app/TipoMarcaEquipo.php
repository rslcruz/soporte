<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class TipoMarcaEquipo extends Model
{
    protected $primaryKey = 'id_tipo_marca_equipo';
	protected $table = 'tipo_marca_equipo';
	protected $fillable = ['marca_equipo_id','tipo_equipo_id'];
	public $timestamps = false;

	 protected $casts = [
       'id_tipo_marca_equipo'  => 'integer',
       'marca_equipo_id'       => 'integer',
       'tipo_equipo_id'        => 'integer',
       
       
       
    ];

	public function marcaEquipo(){
		return $this->belongsTo('API\MarcaEquipo','marca_equipo_id');
	}

	public function tipoEquipo(){
		return $this->belongsTo('API\TipoEquipo','tipo_equipo_id');
	}
}

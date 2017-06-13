<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Almequi_tipo_marca_equipo extends Model
{
    

    protected $primaryKey = 'id_almequi_tipo_marca_equipo';
	protected $table = 'almequi_tipo_marca_equipo';
	protected $fillable = ['id_almequi_marca_equipo','id_almequi_tipo_equipo'];
	public $timestamps = false;

	 protected $casts = [
	    'id_almequi_tipo_marca_equipo' => 'integer',
        'id_almequi_marca_equipo'      => 'integer',
        'id_almequi_tipo_equipo'       => 'integer',
        
    ];

	public function almequimarcaequipo(){
	return $this->belongsTo('API\Almequi_marca_equipo');
	}


	public function almequitipoequipo(){
	return $this->belongsTo('API\Almequi_tipo_equipo');
	}
}
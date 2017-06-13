<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Almequi_modelo_equipo extends Model
{
	protected $primaryKey = 'id_almequi_modelo_equipo';
    protected $table = 'almequi_modelo_equipo';
	protected $fillable = ['modelo_equipo','id_almequi_tipo_marca_equipo'];

	protected $casts = [
        'id_almequi_modelo_equipo'        => 'integer',
        'modelo_equipo'                   => 'string',
        'id_almequi_tipo_marca_equipo'    => 'integer',
    ];

	public function almequitipomarcaequipo()
    {
        return $this->belongsTo('API\Almequi_tipo_marca_equipo');
    }
}

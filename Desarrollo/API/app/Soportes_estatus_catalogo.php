<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Soportes_estatus_catalogo extends Model
{
    protected $primaryKey = 'id_soportes_estatus_catalogo';
    protected $table = 'soportes_estatus_catalogo';
    public $timestamps = false;
	protected $fillable = [
	'estatus',
	'descripcion',
	'orden'];


	protected $casts = [
        'id_soportes_estatus_catalogo'           => 'integer',
		'estatus'                                => 'string',
		'descripcion'                            => 'string',
		'orden'                                  => 'integer',
		
    ];

	
}



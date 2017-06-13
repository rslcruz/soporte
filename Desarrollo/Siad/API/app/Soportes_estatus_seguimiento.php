<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Soportes_estatus_seguimiento extends Model
{
    protected $primaryKey = 'id_soportes_estatus_seguimiento';
    protected $table = 'soportes_estatus_seguimiento';
    public $timestamps = false;
	protected $fillable = [
	'fecha',
	'estatus',
	'id_soportes_estatus_catalogo',
	'id_soportes',
	'id_usuario'];


	protected $casts = [
        'id_soportes_estatus_seguimiento'        => 'integer',
		'estatus'                                => 'integer',
		'id_soportes_estatus_catalogo'           => 'integer',
		'id_soportes'                            => 'integer',
		'id_usuario'                             => 'integer',
    ];

	public function soportesestatuscatalogo(){
		return $this->belongsTo('API\Soportes_estatus_catalogo','id_soportes_estatus_catalogo');
	}
}



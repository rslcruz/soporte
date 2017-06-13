<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Almequi_marca_equipo extends Model
{
	protected $table = 'almequi_marca_equipo';
    protected $primaryKey = 'id_almequi_marca_equipo';
	protected $fillable = ['marca_equipo'];
	public $timestamps = false;

	protected $casts = [
        'id_almequi_marca_equipo'  => 'integer',
        'marca_equipo'             => 'string',
    ];
}

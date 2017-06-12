<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Soportes_nivel_servicio extends Model
{
    protected $primaryKey = 'id_soportes_nivel_servicio';
    protected $table = 'soportes_nivel_servicio';
    public $timestamps = false;
	protected $fillable = [
    'tiempo',
    'fecha_inicio',
    'fecha_fin',
    'nivel_servicio'];

	protected $casts = [
        'id_soportes_nivel_servicio' => 'integer',
        'nivel_servicio'             => 'integer',
        
    ];

	
}

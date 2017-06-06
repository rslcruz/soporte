<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $primaryKey = 'id_ubicacion';
    protected $table = 'ubicacion';
	protected $fillable = ['id_ubicacion','edificio','piso'];
	public $timestamps = false;


	 protected $casts = [
       'id_ubicacion'   => 'integer',
       'edificio'       => 'string',
       'piso'           => 'string',
       
       
       
    ];
}
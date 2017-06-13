<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Almequi_area extends Model
{
    protected $primaryKey = 'id_almequi_area';
	protected $table = 'almequi_area';
	protected $fillable = ['id_almequi_area','area','incono_vista'];
	public $timestamps = false;

    protected $casts = [
       'id_almequi_area'      => 'integer',
       'area'                 => 'string',
       'incono_vista'         => 'string',
       
       
    ];
	public function almequisubarea()
    {
        return $this->hasOne('API\Almequi_subarea');
    }
}

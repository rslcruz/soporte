<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
	protected $primaryKey = 'id_area';
    protected $table = 'area';
	protected $fillable = ['area'];

	protected $casts = [
        'id_area' => 'integer',
        'area'    => 'string',
    ];

	public function subareas()
    {
        return $this->hasMany('API\Subarea');
    }
}

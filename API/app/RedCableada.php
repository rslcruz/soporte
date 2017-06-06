<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class RedCableada extends Model
{
    protected $primaryKey = 'id_red_cableada';
    protected $table = 'red_cableada';
    public $timestamps = false;
	protected $fillable = ['id_red_cableada','nodo','puerto','longitud','categoria','velocidad','switch_id'];

	protected $casts = [
        'id_red_cableada' => 'integer',
        'nodo'            => 'integer',
        'puerto'          => 'string',
        'longitud'        => 'double',
        'categoria'       => 'string',
        'velocidad'       => 'integer',
        'switch_id'       => 'integer',
    ];

	public function switch(){
		return $this->belongsTo('API\Switche','switch_id');
	}
}

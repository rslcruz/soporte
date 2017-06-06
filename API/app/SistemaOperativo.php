<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class SistemaOperativo extends Model
{
    protected $primaryKey = 'id_sistema_operativo';
    protected $table = 'sistema_operativo';
    public $timestamps = false;
	protected $fillable = ['id_sistema_operativo','sistema_operativo','marca_sistema_operativo_id'];
	protected $casts = [
        'id_sistema_operativo'        => 'integer',
		'sistema_operativo'           => 'string',
		'marca_sistema_operativo_id'  => 'integer',
    ];

	public function marcaSistemaOperativo(){
		return $this->belongsTo('API\MarcaSistemaOperativo','marca_sistema_operativo_id');
	}
}



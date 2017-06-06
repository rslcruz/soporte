<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class VersionSistemaOperativo extends Model
{
    protected $primaryKey = 'id_version_sistema_operativo';
    protected $table = 'version_sistema_operativo';
    public $timestamps = false;
	protected $fillable = ['id_version_sistema_operativo','version_sistema_operativo','sistema_operativo_id'];



	 protected $casts = [
       
		'id_version_sistema_operativo'   => 'integer',
		'version_sistema_operativo'	     => 'string',
		'sistema_operativo_id'           => 'integer',
	       
    ];

	public function sistemaOperativo(){
		return $this->belongsTo('API\SistemaOperativo','sistema_operativo_id');
	}
}

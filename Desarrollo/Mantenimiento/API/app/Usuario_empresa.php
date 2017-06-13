<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Usuario_empresa extends Model
{
    protected $primaryKey = 'id_usuario_empresa';
    protected $table = 'usuario_empresa';
    public $timestamps = false;
	protected $fillable = ['id_usuario_empresa','empresa'];

	protected $casts = [   

				'id_usuario_empresa' => 'integer',
				'empresa'	 => 'string',					

    ];

     

}

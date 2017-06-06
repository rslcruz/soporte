<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Antivirus extends Model
{
    protected $primaryKey = 'id_antivirus';
    protected $table = 'antivirus';
    public $timestamps = false;
	protected $fillable = ['antivirus'];

	protected $casts = [
	    'id_antivirus' => 'integer',
        'antivirus'    => 'string',
    ];
}

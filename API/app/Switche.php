<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Switche extends Model
{
    protected $primaryKey = 'id_switch';
	protected $table = 'switch';
	protected $fillable = ['id_switch','ip','mask'];
	public $timestamps = false;

    protected $casts = [
       'id_switch'    => 'integer',
       'ip'           => 'string',
       'mask'         => 'string',
       
       
    ];
	public function inventario()
    {
        return $this->hasOne('API\Inventario','switch_id');
    }
}

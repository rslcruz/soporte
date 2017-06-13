<?php

namespace API;

use Illuminate\Database\Eloquent\Model;

class Almequi extends Model
{
    protected $primaryKey = 'cod_barras';
	protected $table = 'almequi';
	protected $fillable = [
  'subcuenta',
  'partida_esp',
  'valor',
  'codigo',
  'cve_int',
  'clabecabms',
  'descort',
  'estado',
  'unidad',
  'marca',
  'modelo',
  'serie',
  'fecha_alta',
  'alta',
  'cvealta',
  'numresgua',
  'nom_resgua',
  'rfc',
  'ubicacion',
  'localizacion',
  'fecha_resg',
  'numpedido',
  'fecpedido',
  'proveedor',
  'num',
  'control',
  'control2',
  'consumo',
  'num_nuevo',
  'numinvent',
  'nombre',
  'ubica2',
  'resgua2',
  'fecha',
  'pagador',
  'verifica',
  'no_encontr',
  'observacio'];
	public $timestamps = false;

    protected $casts = [
  'cod_barras'      => 'integer',
  'subcuenta'       => 'integer',
  'partida_esp'     => 'integer',
  'valor'           => 'integer',
  'codigo'          => 'string',
  'cve_int'         => 'string',
  'clabecabms'      => 'string',
  'descort'         => 'string',
  'estado'          => 'string',
  'unidad'          => 'string',
  'marca'           => 'string',
  'modelo'          => 'string',
  'serie'           => 'string',
  'fecha_alta'      => 'date',
  'alta'            => 'string',
  'cvealta'         => 'string',
  'numresgua'       => 'integer',
  'nom_resgua'      => 'string',
  'rfc'             => 'string',
  'ubicacion'       => 'integer',
  'localizacion'    => 'integer',
  'fecha_resg'      => 'date',
  'numpedido'       => 'integer',
  'fecpedido'       => 'date',
  'proveedor'       => 'string',
  'num'             => 'integer',
  'control'         => 'string',
  'control2'        => 'string',
  'consumo'         => 'string',
  'num_nuevo'       => 'integer',
  'numinvent'       => 'integer',
  'nombre'          => 'string',
  'ubica2'          => 'string',
  'resgua2'         => 'string',
  'fecha'           => 'date',
  'pagador'         => 'string',
  'verifica'        => 'string',
  'no_encontr'      => 'string',
  'observacio'      => 'string',      
    ];
	
}

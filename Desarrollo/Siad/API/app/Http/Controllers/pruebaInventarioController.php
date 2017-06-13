<?php

namespace API\Http\Controllers; 

use Illuminate\Http\Request;

use API\Http\Requests;
use API\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use API\Inventario;
use API\Solicitud;
use DB;

class pruebainventarioController extends Controller
{
    public function __construct(){
        $this->middleware('cors');
        $this->beforeFilter('@find', ['only' => ['show','update','destroy']]);
    }

    public function find(Route $route){
        $this->inventario = Inventario::find($route->getParameter('inventarios'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $solicitudes = Solicitud::all();

        foreach ($solicitudes as $solicitud)
        {
            
            $solicitud->inventario;
          
          

           //dd($solicitud->usuario);
      
          
            
            }
       return response()->json($solicitudes->toArray());



        // $sql = 'select s.id_solicitud_soporte,s.falla_reportada,s.inventario_id,i.descripcion,
        // r.nombre,s.fecha_apertura,u.nombre from solicitud_soporte s
        // inner join inventario i on s.inventario_id = i.id_inventario
        // inner join resguardante r on r.id_resguardante = i.resguardante_id
        // inner join usuario u on u.id_usuario = s.tecnico_id
        // where s.estatus_solicitud_id = 2';

        // $sql = 'select * from solicitud_soporte';
        // dd($sql);
        // $solicitudes = DB::table('solicitud_soporte')->get();

        // dd($solicitudes);
        //  return response()->json($solicitudes);
      


          //dd(1111111); 
        // $arrayInventarios = array( ); 
        // $inventarios = DB::table('inventario')


        //     ->select(
        //         'inventario.*',
        //         'solicitud_soporte.id_solicitud_soporte',
        //         'solicitud_soporte.falla_reportada',
        //         'solicitud_soporte.observaciones',
        //         'solicitud_soporte.diagnostico',
        //         'solicitud_soporte.tipo_atencion'

        //         )
        //     ->join('solicitud_soporte','inventario.id_inventario' , '=','solicitud_soporte.inventario_id' )
            
            
           
        //     ->get();

        // foreach ($inventarios as $inventario){
        //     array_push($arrayInventarios, array(
        //         'id_inventario' => $inventario->id_inventario,
        //         'descripcion' => $inventario->descripcion,
        //         'serie' => $inventario->serie,
        //         'activo' => $inventario->activo,
        //         'fecha_alta' => $inventario->fecha_alta,
        //         'responsiva_firmada' => $inventario->responsiva_firmada,
        //         'solicitud_soporte' => array(
        //                     //'inventario_id' => $inventario->id_inventario,
        //                     'id_solicitud_soporte' => $inventario->id_solicitud_soporte,
        //                     'falla_reportada' => $inventario->falla_reportada,
        //                     'observaciones'   => $inventario->observaciones,
        //                     'diagnostico'     => $inventario->diagnostico,
        //                     'tipo_atencion'   => $inventario->tipo_atencion


        //                     )
                
                
        //         ));
        // }
        return $arrayInventarios;
    }

    public function getComputadoras()
    {
        $arrayInventarios = array( );   
        $inventarios = DB::table('inventario')
            ->select(
                'inventario.*',
                'resguardante.nombre',
                'resguardante.apellido_paterno',
                'resguardante.apellido_materno',
                'resguardante.subarea_id',
                'modelo_equipo.modelo_equipo',
                'marca_equipo.marca_equipo',
                'tipo_equipo.tipo_equipo',
                'fecha_alta',
                'responsiva_firmada',
                'computadora.ip',
                'computadora.mac_address',
                'antivirus.antivirus'
                )
            ->join('resguardante','inventario.resguardante_id' , '=','resguardante.id_resguardante' )
            ->join('modelo_equipo','inventario.modelo_equipo_id', '=','modelo_equipo.id_modelo_equipo' )
            ->join('tipo_marca_equipo','modelo_equipo.tipo_marca_equipo_id','=','tipo_marca_equipo.id_tipo_marca_equipo')
            ->join('marca_equipo','marca_equipo.id_marca_equipo','=','tipo_marca_equipo.marca_equipo_id')
            ->join('tipo_equipo','tipo_marca_equipo.tipo_equipo_id','=', 'tipo_equipo.id_tipo_equipo')
            ->join('computadora','inventario.computadora_id', '=', 'computadora.id_computadora')
            ->join('antivirus', 'computadora.antivirus_id', '=', 'antivirus.id_antivirus')
            ->orderBy('activo','DESC')
            ->orderBy('id_inventario')
            ->whereNotNull('computadora_id')
            ->get();

        foreach ($inventarios as $inventario){
            array_push($arrayInventarios, array(
                'id_inventario' => $inventario->id_inventario,
                'descripcion' => $inventario->descripcion,
                'serie' => $inventario->serie,
                'activo' => $inventario->activo,
                'fecha_alta' => $inventario->fecha_alta,
                'responsiva_firmada' => $inventario->responsiva_firmada,
                'resguardante_id' => $inventario->resguardante_id,
                'resguardante' => array(
                    'id_resguardante' => $inventario->resguardante_id,
                    'nombre' => $inventario->nombre, 
                    'apellido_paterno' => $inventario->apellido_paterno, 
                    'apellido_materno' => $inventario->apellido_materno, 
                    'subarea_id' => $inventario->subarea_id, 
                    ),
                'modelo' => array(
                    'modelo_equipo' => $inventario->modelo_equipo,
                    'tipo_marca_equipo' =>array(
                        'marca_equipo' => array(
                            'marca_equipo' => $inventario->marca_equipo
                            ),
                        'tipo_equipo' => array(
                            'tipo_equipo' => $inventario->tipo_equipo
                            )
                        )
                    ),
                'computadora' => array(
                    'ip' => $inventario->ip,
                    'mac_address' => $inventario->mac_address,
                    'antivirus' => array(
                        'antivirus' => $inventario->antivirus
                        )
                    ),
                
                ));
        }
        return $arrayInventarios;
    }

    public function getInventario(){
        ini_set('max_execution_time', 180);
        $inventarios = Inventario::orderBy('activo','DESC')->orderBy('id_inventario')->get();
        foreach ($inventarios as $inventario){
            //INFORMACION DE RESGUARDANTE
            if($inventario->resguardante){
                if($inventario->resguardante->subarea){
                    $inventario->resguardante->subarea->area;
                }
                $inventario->resguardante->ubicacion;
            }
            //INFORMACION DEL USUARIO (SI EXISTE)
            if($inventario->encargado){
                if($inventario->encargado->subarea){
                    $inventario->encargado->subarea->area;
                }
                $inventario->encargado->ubicacion;
            }
            //INFORMACION DEL MODELO
            if($inventario->modelo){
                if($inventario->modelo->tipoMarcaEquipo){
                    $inventario->modelo->tipoMarcaEquipo->marcaEquipo;
                    if($inventario->modelo->tipoMarcaEquipo->tipoEquipo){
                        $inventario->modelo->tipoMarcaEquipo->tipoEquipo->clasificacionTipoEquipo;
                    }
                }
            }
            //INFORMACION SI ES COMPUTADORA
            if($inventario->computadora){
                $inventario->computadora->antivirus;
                if($inventario->computadora->versionSistemaOperativo){
                    if($inventario->computadora->versionSistemaOperativo->sistemaOperativo){
                        $inventario->computadora->versionSistemaOperativo->sistemaOperativo->marcaSistemaOperativo;
                    }
                }
                //INFORMACION SI TIENE RED CABLEADA
                if($inventario->computadora->redCableada){
                   $inventario->computadora->redCableada->switch; 
                }
            }
            //INFORMACION SI ES SWITCH
            $inventario->switch;

            //INFORMACION DE UBICACION
            $inventario->ubicacion;
        }
        return response()->json($inventarios->toArray());
    }

    public function getComputadorasFull(){
        ini_set('max_execution_time', 180);
        $inventarios = Inventario::orderBy('activo','DESC')
            ->orderBy('id_inventario')
            ->whereNotNull('computadora_id')
            ->get();
        foreach ($inventarios as $inventario){
            //INFORMACION DE RESGUARDANTE
            if($inventario->resguardante){
                if($inventario->resguardante->subarea){
                    $inventario->resguardante->subarea->area;
                }
                $inventario->resguardante->ubicacion;
            }
            //INFORMACION DEL USUARIO (SI EXISTE)
            if($inventario->encargado){
                if($inventario->encargado->subarea){
                    $inventario->encargado->subarea->area;
                }
                $inventario->encargado->ubicacion;
            }
            //INFORMACION DEL MODELO
            if($inventario->modelo){
                if($inventario->modelo->tipoMarcaEquipo){
                    $inventario->modelo->tipoMarcaEquipo->marcaEquipo;
                    if($inventario->modelo->tipoMarcaEquipo->tipoEquipo){
                        $inventario->modelo->tipoMarcaEquipo->tipoEquipo->clasificacionTipoEquipo;
                    }
                }
            }
            //INFORMACION SI ES COMPUTADORA
            if($inventario->computadora){
                $inventario->computadora->antivirus;
                if($inventario->computadora->versionSistemaOperativo){
                    if($inventario->computadora->versionSistemaOperativo->sistemaOperativo){
                        $inventario->computadora->versionSistemaOperativo->sistemaOperativo->marcaSistemaOperativo;
                    }
                }
                //INFORMACION SI TIENE RED CABLEADA
                if($inventario->computadora->redCableada){
                   $inventario->computadora->redCableada->switch; 
                }
            }
            //INFORMACION DE UBICACION
            $inventario->ubicacion;
        }
        return response()->json($inventarios->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Inventario::create($request->all());
        return response()->json(["mensaje" => "creado"]);   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($this->inventario){
            $this->inventario->ubicacion;
            if($this->inventario->modelo){
                $this->inventario->modelo->tipoMarcaEquipo->marcaEquipo;
                $this->inventario->modelo->tipoMarcaEquipo->tipoEquipo;
            }
            if($this->inventario->resguardante){
                if($this->inventario->resguardante->subarea){
                    $this->inventario->resguardante->subarea->area;
                }
                $this->inventario->resguardante->ubicacion;
            }
            if($this->inventario->encargado){
                if($this->inventario->encargado->subarea){
                    $this->inventario->encargado->subarea->area;
                }
                $this->inventario->encargado->ubicacion;
            }
            if($this->inventario->computadora){
                if($this->inventario->computadora->versionSistemaOperativo){
                    $this->inventario->computadora->versionSistemaOperativo->sistemaOperativo->marcaSistemaOperativo;
                }
                $this->inventario->computadora->redCableada;
            }
        }
        return response()->json($this->inventario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function getSubarea($id)
    {
        $arrayInventarios = array( );   
        $inventarios = DB::table('inventario')
            ->select(
                'inventario.*',
                'resguardante.nombre',
                'resguardante.apellido_paterno',
                'resguardante.apellido_materno',
                'resguardante.subarea_id',
                'modelo_equipo.modelo_equipo',
                'marca_equipo.marca_equipo',
                'tipo_equipo.tipo_equipo'
                )
            ->join('resguardante', 'resguardante.id_resguardante', '=', 'inventario.resguardante_id')
            ->join('modelo_equipo','modelo_equipo.id_modelo_equipo', '=', 'inventario.modelo_equipo_id')
            ->join('tipo_marca_equipo','tipo_marca_equipo.id_tipo_marca_equipo','=','modelo_equipo.id_modelo_equipo')
            ->join('marca_equipo','marca_equipo.id_marca_equipo','=','tipo_marca_equipo.marca_equipo_id')
            ->join('tipo_equipo','tipo_equipo.id_tipo_equipo','=','tipo_marca_equipo.tipo_equipo_id')
            ->join('clasificacion_tipo_equipo','clasificacion_tipo_equipo.id_clasificacion_tipo_equipo','=','tipo_equipo.clasificacion_tipo_equipo_id')
            ->where('resguardante.subarea_id', '=', $id)
            ->get();

        foreach ($inventarios as $inventario){
            array_push($arrayInventarios, array(
                'id_inventario' => $inventario->id_inventario,
                'descripcion' => $inventario->descripcion,
                'serie' => $inventario->serie,
                'activo' => $inventario->activo,
                'resguardante_id' => $inventario->resguardante_id,
                'resguardante' => array(
                    'id_resguardante' => $inventario->resguardante_id,
                    'nombre' => $inventario->nombre, 
                    'apellido_paterno' => $inventario->apellido_paterno, 
                    'apellido_materno' => $inventario->apellido_materno, 
                    'subarea_id' => $inventario->subarea_id, 
                    ),
                'modelo' => array(
                    'modelo_equipo' => $inventario->modelo_equipo,
                    'tipo_marca_equipo' =>array(
                        'marca_equipo' => array(
                            'marca_equipo' => $inventario->marca_equipo
                            ),
                        'tipo_equipo' => array(
                            'tipo_equipo' => $inventario->tipo_equipo
                            )
                        )
                    )
                ));
        }
        return $arrayInventarios;
    }

    public function getResguardanteSubareas(){
        $subareas = Subarea::all();
        foreach ($subareas as $subarea) { 
            $subarea->resguardantes;
        }
        return response()->json($subareas);
    }

    public function inventarioExistente($id)
    {
        $existe = Inventario::where("id_inventario",'=',$id)->count();
         return $existe;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->inventario->fill($request->all());
        $this->inventario->save();
        return response()->json(["mensaje"=>"modificado"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}


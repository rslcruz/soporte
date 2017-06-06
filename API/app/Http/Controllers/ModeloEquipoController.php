<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;

use API\Http\Requests;
use API\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use API\ClasificacionTipoEquipo;
use API\TipoEquipo;
use DB;

class ModeloEquipoController extends Controller
{

    public function __construct(){
        $this->middleware('cors');
        $this->beforeFilter('@find', ['only' => ['show','update']]);
    }

    public function find(Route $route){
        $this->clasificacion = ClasificacionTipoEquipo::find($route->getParameter('clasificacionTipoEquipo'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clasificaciones = ClasificacionTipoEquipo::all();
        return response()->json($clasificaciones->toArray());
    }

    public function getTiposEquipo($id)
    {
        $tipos = TipoEquipo::where('clasificacion_tipo_equipo_id','=',$id)->get();
        return response()->json($tipos->toArray());
    }

    public function getMarcasEquipo($id)
    {
        $arrayMarcas = array();
        $marcas = DB::table('tipo_marca_equipo')
                    ->join('marca_equipo','tipo_marca_equipo.marca_equipo_id','=','marca_equipo.id_marca_equipo')
                    ->join('tipo_equipo','tipo_marca_equipo.tipo_equipo_id','=','tipo_equipo.id_tipo_equipo')
                    ->where('tipo_equipo_id','=',$id)
                    ->get();
        foreach ($marcas as $marca) {
            array_push($arrayMarcas, array(
                'id_marca_equipo' => $marca->id_marca_equipo,
                'marca_equipo' => $marca->marca_equipo,
                ));
        }
        return $arrayMarcas;
    }

    public function getModelosEquipo($idMarca,$idTipo)
    {
        $arrayModelos = array();
        $modelos = DB::table('modelo_equipo')
                    ->join('tipo_marca_equipo','tipo_marca_equipo.id_tipo_marca_equipo','=','modelo_equipo.tipo_marca_equipo_id')
                    ->where('marca_equipo_id','=',$idMarca)
                    ->where('tipo_equipo_id','=',$idTipo)
                    ->select('id_modelo_equipo','modelo_equipo')
                    ->get();
                    foreach ($modelos as $modelo) {
                        array_push($arrayModelos, array(
                            'id_modelo_equipo' => $modelo->id_modelo_equipo,
                            'modelo_equipo' => $modelo->modelo_equipo
                            ));
                    }
        return $arrayModelos;
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
        ClasificacionTipoEquipo::create($request->all());
        return response()->json(["mensaje" => "creado correctamente"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $item = ClasificacionTipoEquipo::findOrFail($request->id_clasificacion_tipo_equipo);
            $item->clasificacion_tipo_equipo=$request->clasificacion_tipo_equipo;
            $item->save();
            return response()->json(["mensaje"=>"modificada"]);
        }catch(\Illuminate\Database\QueryException $e){
            return response()->json(["mensaje"=>"no modificada"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ClasificacionTipoEquipo::findOrFail($id);
        try{
             $item->delete();
             return response()->json(["mensaje"=>"borrada"]);
        }catch(\Illuminate\Database\QueryException $e){
            return response()->json(["mensaje"=>"no borrada"]);
        }
    }
}

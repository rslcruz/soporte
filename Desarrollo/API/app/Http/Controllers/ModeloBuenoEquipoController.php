<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;

use API\Http\Requests;
use API\Http\Controllers\Controller;
use API\ModeloEquipo;
use API\TipoMarcaEquipo;

class ModeloBuenoEquipoController extends Controller
{

    public function __construct(){
        $this->middleware('cors');
        // $this->beforeFilter('@find', ['only' => ['show','update','destroy']]);
    }

    // public function find(Route $route){
    //     $this->modelo = Modelo::find($route->getParameter('modeloEquipo'));
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoMarcaEquipo = TipoMarcaEquipo::where('marca_equipo_id','=',$request->marca_equipo_id)
                            ->where('tipo_equipo_id','=',$request->tipo_equipo_id)
                            ->get()->first();

        ModeloEquipo::create([
            'modelo_equipo' => $request->modelo_equipo,
            'tipo_marca_equipo_id' => $tipoMarcaEquipo->id_tipo_marca_equipo
        ]);
        return response()->json(["mensaje" => "creado correctamente"]);
        // return response()->json($tipoMarcaEquipo);
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
            $item = ModeloEquipo::findOrFail($request->id_modelo_equipo);
            $item->modelo_equipo=$request->modelo_equipo;
            $item->save();
            return response()->json(["mensaje"=>"modificado"]);
        }catch(\Illuminate\Database\QueryException $e){
            return response()->json(["mensaje"=>"no modificado"]);
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
        $item = ModeloEquipo::findOrFail($id);
        try{
            $item->delete();
            return response()->json(["mensaje"=>"borrado"]);
        }catch(\Illuminate\Database\QueryException $e){
            return response()->json(["mensaje"=>"no borrado"]);
        }
    }
}

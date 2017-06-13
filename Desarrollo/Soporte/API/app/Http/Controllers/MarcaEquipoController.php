<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;

use API\Http\Requests;
use API\Http\Controllers\Controller;
use API\MarcaEquipo;
use API\TipoMarcaEquipo;
use DB;

class MarcaEquipoController extends Controller
{
    public function __construct(){
        $this->middleware('cors');
        // $this->beforeFilter('@find', ['only' => ['show','update','destroy']]);
    }

    // public function find(Route $route){
    //     $this->tipo = MarcaEquipo::find($route->getParameter('marcaEquipo'));
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = MarcaEquipo::all();
        return response()->json($marcas->toArray());
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
        if($request->id_marca_equipo==null){
            $marcaInsertada = MarcaEquipo::create([
                'marca_equipo' => $request->marca_equipo
                ]);

            TipoMarcaEquipo::create([
                'marca_equipo_id' => $marcaInsertada->id_marca_equipo,
                'tipo_equipo_id' => $request->tipo_equipo_id
                ]);

        }else{
            TipoMarcaEquipo::create([
                'marca_equipo_id' => $request->id_marca_equipo,
                'tipo_equipo_id' => $request->tipo_equipo_id
                ]);
        }

        
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
            $item = MarcaEquipo::findOrFail($request->id_marca_equipo);
            $item->marca_equipo=$request->marca_equipo;
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
    public function destroy($id,$idTipo)
    {
        $tipoMarcaEquipo = TipoMarcaEquipo::where('marca_equipo_id','=',$id)
                            ->where('tipo_equipo_id','=',$idTipo)
                            ->get()->first();
        $vecesMarca = TipoMarcaEquipo::where('marca_equipo_id','=',$id)
                            ->get()->count();
        try{
            $tipoMarcaEquipo->delete();
            if($vecesMarca==1){
                $item = MarcaEquipo::findOrFail($id);
                $item->delete();
            }
            return response()->json(["mensaje"=>"borrada"]);
        }catch(\Illuminate\Database\QueryException $e){
            return response()->json(["mensaje"=>"no borrada"]);
        }
    }
}

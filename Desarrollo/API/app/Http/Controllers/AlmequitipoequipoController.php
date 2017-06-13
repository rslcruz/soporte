<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;

use API\Http\Requests;
use API\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use API\Almequi_tipo_equipo;


class AlmequitipoequipoController extends Controller
{
    public function __construct(){
        $this->middleware('cors');
        $this->beforeFilter('@find', ['only' => ['show','update','destroy']]);
    }

    public function find(Route $route){      
        
        $this->tipo_equipo = Almequi_tipo_equipo::find($route->getParameter('almequite'));
         
        
    }
    //  public function find($id){
    //     $resultado = Almequi_tipo_equipo::find($id);
    //      //return response()->json($resultado);
    //     dd($resultado);  
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_equipos = Almequi_tipo_equipo::all();
        return response()->json($tipo_equipos->toArray());
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
        Almequi_tipo_equipo::create($request->all());
        return response()->json(["mensaje" => "creado correctamente"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_almequi_tipo_equipo)
    {   
        if ($this->tipo_equipo) {
           $this->tipo_equipo->almequiclasificaciontipoequipo;
        }

         return response()->json($this->tipo_equipo);




        
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
    public function update(Request $request, $id_tipo_equipo)
    {
        $this->tipo_equipo->fill($request->all());
        $this->tipo_equipo->save();
        return response()->json(["mensaje"=>"Actualizado"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_almequi_tipo_equipo)
    {
        try{
            $this->tipo_equipo->delete();
            return response()->json(["mensaje"=>"borrado"]);
        }catch(\Illuminate\Database\QueryException $e){
            return response()->json(["mensaje"=>"no borrado"]);
        }
    }
}

<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;

use API\Http\Requests;
use API\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use API\Clasificacion_reparacion;

class ClasificacionReparacionController extends Controller
{
    

    public function __construct(){
        $this->middleware('cors');
        $this->beforeFilter('@find', ['only' => ['show','update','destroy']]);

}


 public function find(Route $route){
        $this->tipo = Clasificacion_reparacion::find($route->getParameter('tipos'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $clasificacion = Clasificacion_reparacion::all();





        foreach ($clasificacion as $clas)
        {          
          $clas ->tipoReparacion;

         }
        return response()->json($clasificacion->toArray());

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getclasificacionReparacion($id){

    $clas = Clasificacion_reparacion::where('tipo_reparacion_id', '=', $id)
    -> where('tipo_clas','=',2)
    ->get(['id_clasificacion_reparacion','Clasificacion_reparacion']);
 
          return response()->json($clas->toArray()); 

    }



    public function show($id)
    {
    
    $clas = Clasificacion_reparacion::where('tipo_reparacion_id', '=', $id)
    -> where('tipo_clas','=',1)
    ->get(['id_clasificacion_reparacion','Clasificacion_reparacion']);
 
          return response()->json($clas->toArray());   
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
        //
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

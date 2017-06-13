<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;

use API\Http\Requests;
use Illuminate\Routing\Route;
use API\Http\Controllers\Controller;
use API\subclasificacion_reparacion;

class SubclasificacionReparacionController extends Controller
{
    
      public function __construct(){
        $this->middleware('cors');
        $this->beforeFilter('@find', ['only' => ['show','update','destroy']]);

}


 public function find(Route $route){
        $this->tipo = subclasificacion_reparacion::find($route->getParameter('tipo'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subclasificacion = subclasificacion_reparacion::all();

        foreach ($subclasificacion as $subc)
        {    
 
         if($subc->clasificacionReparacion){
                $subc->clasificacionReparacion->tipoReparacion;
            }
          

         }

        return response()->json($subclasificacion->toArray());
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

   public function getsubclasificacionReparacion($id)
    {
    $clas = subclasificacion_reparacion::where('clasificacion_reparacion_id', '=', $id)
    ->where('tipo_sub' ,'=',2)
    ->get(['id_subclasificacion_reparacion','subclasificacion_reparacion']);
 
          return response()->json($clas->toArray());
    }




    public function show($id)
    {
    $clas = subclasificacion_reparacion::where('clasificacion_reparacion_id', '=', $id)
    ->where('tipo_sub' ,'=',1)
    ->get(['id_subclasificacion_reparacion','subclasificacion_reparacion']);
 
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

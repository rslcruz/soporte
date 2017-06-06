<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;

use API\Http\Requests;
use API\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use API\Computadora;
use API\RedCableada;

class ComputadoraController extends Controller
{
    public function __construct(){
        $this->middleware('cors');
        // $this->beforeFilter('@find', ['only' => ['show','update','destroy']]);
    }

    // public function find(Route $route){
    //     $this->computadora = Computadora::find($route->getParameter('computadoras'));
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
        $redCableada = RedCableada::create([
            'nodo' => $request->RedCableada['nodo'],
            'puerto' => $request->RedCableada['puerto'],
            'longitud' => $request->RedCableada['longitud'],
            'categoria' => $request->RedCableada['categoria'],
            'velocidad' => $request->RedCableada['velocidad'],
            'switch_id' => $request->RedCableada['switch_id']
            ]);
        
        $insertada = Computadora::create([
            'ip' => $request->ip,
            'mac_address' => $request->mac_address,
            'sistema_operativo_version_id' => $request->sistema_operativo_version_id,
            'antivirus_id' => $request->antivirus_id,
            'accesorios' => $request->accesorios,
            'cambio_nombre_equipo' => $request->cambio_nombre_equipo,
            'ingreso_a_dominio' => $request->ingreso_a_dominio,
            'ocs_inventory' => $request->ocs_inventory,
            'nombre_usuario_dominio' => $request->nombre_usuario_dominio,
            'red_cableada_id' => $redCableada->id_red_cableada,
            'version_office' => $request->version_office,
            'observaciones' => $request->observaciones,
            ]);
        return response()->json($insertada);
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
    public function update(Request $request, $id_computadora)
    {
        $computadora = Computadora::find($id_computadora);
        $computadora->fill($request->all());

        if($request->red_cableada_id!=null){
            $redCableada = RedCableada::find($request->red_cableada_id);
            $redCableada->nodo = $request->red_cableada['nodo'];
            $redCableada->puerto = $request->red_cableada['puerto'];
            $redCableada->longitud = $request->red_cableada['longitud'];
            $redCableada->categoria = $request->red_cableada['categoria'];
            $redCableada->velocidad = $request->red_cableada['velocidad'];
            $redCableada->switch_id = $request->red_cableada['switch_id'];
            $redCableada->save();
        }
        $computadora->save();
        return response()->json(["mensaje"=>"modificada"]);
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

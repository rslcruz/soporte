<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;

use API\Http\Requests;
use API\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use API\Switche;
use API\Ubicacion;
use DB;

class SwitchController extends Controller
{

    public function __construct(){
        $this->middleware('cors');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $switches = Switche::all();
        foreach ($switches as $switch){
            $switch->inventario->ubicacion;
        }
        return response()->json($switches->toArray());
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
        $switch = Switche::create($request->all());
        return response()->json($switch);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_ubicacion)
    {
        $ubicacion = Ubicacion::find($id_ubicacion);
        $arraySwitches = array();
        $switches = DB::table('switch')
        ->select('switch.*','ubicacion.*')
        ->join('inventario','inventario.switch_id','=','switch.id_switch')
        ->join('ubicacion','ubicacion.id_ubicacion','=','inventario.ubicacion_id')
        ->where('edificio','=',$ubicacion->edificio)
        ->get();

        foreach ($switches as $switch){
            array_push($arraySwitches, array(
                'id_switch' => $switch->id_switch,
                'ip' => $switch->ip,
                'mask' => $switch->mask,
                'inventario' => array(
                    'ubicacion' =>array(
                        'id_ubicacion' => $switch->id_ubicacion,
                        "edificio" => $switch->edificio,
                        "piso"  => $switch->piso
                        )
                    )
                ));
        }

        if (empty($arraySwitches)) {
            array_push($arraySwitches, array(
            'id_switch' => 0,
            'ip' => 0,
            'mask' => 0,
            'inventario' => array(
                'ubicacion' =>array(
                    'id_ubicacion' => 0,
                    "edificio" => 0,
                    "piso"  => 0
                    )
                )
            ));
        }

        return $arraySwitches;
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

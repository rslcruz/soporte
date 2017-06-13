<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;

use API\Http\Requests;
use API\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use API\SistemaOperativo;

class SistemaOperativoController extends Controller
{
    public function __construct(){
        $this->middleware('cors');
        $this->beforeFilter('@find', ['only' => ['show','update','destroy']]);
    }

    public function find(Route $route){
        $this->sistema = SistemaOperativo::find($route->getParameter('sistemasOperativos'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sistemasOperativos = SistemaOperativo::all();
        return response()->json($sistemasOperativos->toArray());
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
        SistemaOperativo::create($request->all());
        return response()->json(["mensaje" => "creado"]);
    }

    public function getSistemaOperativo($marca_sistema_operativo_id)
    {
        $sistemasOperativos = SistemaOperativo::where('marca_sistema_operativo_id','=',$marca_sistema_operativo_id)->get();
        return response()->json($sistemasOperativos->toArray());
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
    public function update(Request $request, $id_sistema_operativo)
    {
        $this->sistema->fill($request->all());
        $this->sistema->save();
        return response()->json(["mensaje"=>"modificado"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_sistema_operativo)
    {
        try{
            $this->sistema->delete();
            return response()->json(["mensaje"=>"borrado"]);
        }catch(\Illuminate\Database\QueryException $e){
            return response()->json(["mensaje"=>"no borrado"]);
        }
    }
}

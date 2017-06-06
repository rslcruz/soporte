<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;

use API\Http\Requests;
use API\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use API\VersionSistemaOperativo;

class VersionSistemaOperativoController extends Controller
{

    public function __construct(){
        $this->middleware('cors');
        $this->beforeFilter('@find', ['only' => ['show','update','destroy']]);
    }

    public function find(Route $route){
        $this->version = VersionSistemaOperativo::find($route->getParameter('versionesSistemaOperativo'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $versiones = VersionSistemaOperativo::all();
        return response()->json($versiones->toArray());
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
        VersionSistemaOperativo::create($request->all());
        return response()->json(["mensaje" => "creado"]);
    }

    public function getVersionesSistemaOperativo($id_sistema_operativo)
    {
        $versiones = VersionSistemaOperativo::where('sistema_operativo_id','=',$id_sistema_operativo)->get();
        return response()->json($versiones->toArray());
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
    public function update(Request $request, $id_version_sistema_operativo)
    {
        $this->version->fill($request->all());
        $this->version->save();
        return response()->json(["mensaje"=>"modificada"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_version_sistema_operativo)
    {
        try{
            $this->version->delete();
            return response()->json(["mensaje"=>"borrada"]);
        }catch(\Illuminate\Database\QueryException $e){
            return response()->json(["mensaje"=>"no borrada"]);
        }
    }
}

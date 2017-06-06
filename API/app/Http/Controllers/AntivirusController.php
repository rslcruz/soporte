<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;

use API\Http\Requests;
use API\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use API\Antivirus;

class AntivirusController extends Controller
{
    public function __construct(){
        $this->middleware('cors');
        $this->beforeFilter('@find', ['only' => ['show','update','destroy']]);
    }

    public function find(Route $route){
        $this->antivirus = Antivirus::find($route->getParameter('antivirus'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $antivirus = Antivirus::all();
        return response()->json($antivirus->toArray());
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
        Antivirus::create($request->all());
        return response()->json(["mensaje" => "creado correctamente"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_antivirus)
    {
         return response()->json($this->antivirus);
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
    public function update(Request $request, $id_antivirus)
    {
        $this->antivirus->fill($request->all());
        $this->antivirus->save();
        return response()->json(["mensaje"=>"Actualizado"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_antivirus)
    {
        try{
            $this->antivirus->delete();
            return response()->json(["mensaje"=>"borrado"]);
        }catch(\Illuminate\Database\QueryException $e){
            return response()->json(["mensaje"=>"no borrado"]);
        }
    }
}

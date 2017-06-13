<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;

use API\Http\Requests;
use API\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use API\Usuario;


class UsuarioController extends Controller
{

    public function __construct(){
        $this->middleware('cors');
        $this->beforeFilter('@find', ['only' => ['show','update','destroy']]);
    }

    public function find(Route $route){
        $this->usuario = Usuario::find($route->getParameter('usuarios'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $usuarios = Usuario::orderBy('activo')->orderBy('nombre')->get();
        foreach ($usuarios as $usuario){
             $usuario->usuarioperfil;
             $usuario->usuarioempresa;
        }
        return response()->json($usuarios->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        Usuario::create([
                'nombre' => $request->nombre,
                'password' => bcrypt($request->password),
                'perfil_id' => $request->perfil_id,
                'nombre_usuario' => $request->nombre_usuario,
                'correo' => $request->correo,
                'empresa_id' => $request->empresa_id,
                'activo' => $request->activo
            ]);
        return response()->json(["mensaje" => "creado correctamente"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id_usuario)
    {
        $this->usuario->usuarioempresa;
        $this->usuario->usuarioperfil;
        return response()->json($this->usuario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id_usuario)
    {
        $this->usuario->fill($request->all());
        if($request->contrasenaNueva){
            $this->usuario->password = bcrypt($request->password);
        }
        $this->usuario->save();
        return response()->json(["mensaje"=>"Actualizado"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->usuario->delete();
        return response()->json(["mensaje"=>"Borrado"]);
    }
}

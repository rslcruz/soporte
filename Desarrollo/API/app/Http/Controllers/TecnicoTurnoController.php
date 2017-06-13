<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;

use API\Http\Requests;
use API\Http\Controllers\Controller;
use API\Usuario;
use API\Solicitud;

class TecnicoTurnoController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // esta funcion nos sirve para ir rolando los tecnicos en cada solicitud

        $arrayTecnicoturn = array(); // tiene los ID de los Tecnicos
        $count =0; // tiene el numero de tecnicos que hay en la B.D
        $n=0; // Se utiliza Para Recorrer el Array
        $p=14;
        $NumTec= Usuario::where('perfil_id', '=', 6)
        ->orderBy('id_usuario','ASC')
        ->get();
        $count=count($NumTec);
  
          foreach ($NumTec as $numt){           
           $arrayTecnicoturn[$n] = $numt->id_usuario;                
           $n++;
           }

           $UltimoTec = Solicitud::orderBy('id_solicitud_soporte','asc')
           ->get()
           ->last();

          $ultimasolicitud= $UltimoTec->tecnico_id;
          $posicion=0;        
         for ($i=0; $i<$count ; $i++) { 
                             
                if($ultimasolicitud ==null || $ultimasolicitud==""){

                     $id_tecnico=$arrayTecnicoturn[0];
                     break;
                }
                 if ($ultimasolicitud == $arrayTecnicoturn[$count-1] ) {
                        $id_tecnico=$arrayTecnicoturn[0];
                        break;             }

                 else if($ultimasolicitud == $arrayTecnicoturn[$posicion]){           
                        $id_tecnico=$arrayTecnicoturn[$posicion+1];
                        break;
                           
             }           

             $posicion++;
         }

          

        $NumTec= Usuario::where('id_usuario', '=', $id_tecnico)
        ->get();
        return response()->json($NumTec->toArray());


                
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

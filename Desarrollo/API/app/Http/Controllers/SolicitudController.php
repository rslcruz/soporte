<?php 

namespace API\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use API\Http\Requests;
use API\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use API\Solicitud;







class SolicitudController extends Controller
{

    public function __construct(){
        $this->middleware('cors');
        $this->beforeFilter('@find', ['only' => ['show','update','destroy']]);
    }

    public function find(Route $route){
        $this->solicitud = Solicitud::find($route->getParameter('solicitudes'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      

      $solicitudes = Solicitud::all();

        foreach ($solicitudes as $solicitud)
        {
            
           $solicitud->servicioSolicitado;
           $solicitud->estatusSolicitud;
       

      
           if($solicitud->inventario){


            $solicitud->inventario->resguardante;
            $solicitud->inventario->encargado;
            }
            if($solicitud->usuario){
                $solicitud->usuario->perfil;
            }
            if($solicitud->tecnico){
                $solicitud->tecnico->perfil;
            }

           
            }
       return response()->json($solicitudes->toArray());
   }



    public function getReporteSolicitudPDF($id)
    {
        //header('Content-Type: text/html; UTF-8');
        $solicitudes = $this->solicitudpdf($id);
        $pdf = PDF::loadView('vista', compact('solicitudes'));
        return $pdf->stream('Reporte_solicitud.pdf');
    }





    public function solicitudpdf($id) 
    {      
    
        $solicitud = Solicitud::find($id);
 
        if($solicitud){
            if($solicitud->inventario){
                if($solicitud->inventario->resguardante){
                   if($solicitud->inventario->resguardante->subarea){
                      $solicitud->inventario->resguardante->subarea->area;
                   }  
                   if($solicitud->inventario->modelo)  
                   {
                    $solicitud->inventario->modelo->tipoMarcaEquipo->marcaEquipo;
                   } 
                }  
            }
            $solicitud->servicioSolicitado;           
            $solicitud->estatusSolicitud;                  
            $solicitud->usuario->perfil;

            if($solicitud->tecnico){
                $solicitud->tecnico->perfil;
            }

            if($solicitud->subclasificacionReparacion){
                if($solicitud->subclasificacionReparacion->clasificacionReparacion){
                    $solicitud->subclasificacionReparacion->clasificacionReparacion->tipoReparacion;
                  }
            }         
        }
        //dd($solicitud);
        //return response()->json($solicitud);
        return $solicitud;
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
        Solicitud::create($request->all());
        return response()->json(["mensaje" => "creada correctamente"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_solicitud_soporte) 
    {
        if($this->solicitud){
            if($this->solicitud->inventario){
                if($this->solicitud->inventario->resguardante){
                   if($this->solicitud->inventario->resguardante->subarea){
                      $this->solicitud->inventario->resguardante->subarea->area;
                   }  
                   if($this->solicitud->inventario->modelo)  
                   {
                    $this->solicitud->inventario->modelo->tipoMarcaEquipo->marcaEquipo;

                   } 
                }  
            }
            $this->solicitud->servicioSolicitado;           
            $this->solicitud->estatusSolicitud;                   
            $this->solicitud->usuario->perfil;
           

            if($this->solicitud->tecnico){
                $this->solicitud->tecnico->perfil;
                 if($this->solicitud->tecnico->empresa){

                $this->solicitud->tecnico->empresa->NivelServicios;

            }

            }


         
                if($this->solicitud->subclasificacionReparacion){
                        if($this->solicitud->subclasificacionReparacion->clasificacionReparacion)
                        {

                        $this->solicitud->subclasificacionReparacion->clasificacionReparacion->tipoReparacion;

                        }

                }
               
     
                    
                  
                
                
        }
        return response()->json($this->solicitud);
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
    public function update(Request $request,$id_solicitud_soporte)
    {
        $this->solicitud->fill($request->all());
        $this->solicitud->save();
        return response()->json(["mensaje"=>"Actualizada"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->solicitud->delete();
        return response()->json(["mensaje"=>"Borrada"]);
    }

    public function prueba()
    {

    return "hola";

    }
}

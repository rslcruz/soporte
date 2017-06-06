<!DOCTYPE html>
<html>
<head>
	<title>Reporte PDF</title>
 <link  href="{{asset('bootstrap.min.css')}}"  rel="stylesheet"> 
	<style>
	 .borde1c{
          	   
                border:#000000;	         
	            border-style:solid; 
	            border-top-width:1px; 
	            border-right-width:1px; 
	            border-bottom-width:1px; 
	            border-left-width:1px; 



          }
          .borde2c{
          	    align-content: center;
                border:#000000;
	            width: 100%;
	            border-style:solid; 
	            border-top-width:2px; 
	            border-right-width:2px; 
	            border-bottom-width:2px; 
	            border-left-width:2px; 



          }
           .borde3{
          	    
                border:#000000;
	            width: 100%;
	            border-style:solid; 
	            border-top-width:1px; 
	            border-right-width:1px; 
	            border-bottom-width:1px; 
	            border-left-width:1px; 

          }
            .borde3si{
          	    
                border:#000000;
	            width: 100%;
	            border-style:solid; 
	            border-top-width:1px; 
	            border-right-width:1px; 
	            border-bottom-width:1px; 
	            border-left-width:0px; 

          }
           .borde3st{
          	    
                border:#000000;
	            width: 100%;
	            border-style:solid; 
	            border-top-width:0px; 
	            border-right-width:1px; 
	            border-bottom-width:1px; 
	            border-left-width:0px; 

          }

            .borde3sti{
          	    
                border:#000000;
	            width: 100%;
	            border-style:solid; 
	            border-top-width:0px; 
	            border-right-width:1px; 
	            border-bottom-width:1px; 
	            border-left-width:1px; 

          }


            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }
            .contenedor{

                border:#000000;	         
	            border-style:solid;
	            border-radius: 15px 15px 15px 15px;    
          
            }

               .letra12
            {

         		font-size:12px; 
				font-family:Arial; 
				color:#414141;
				text-decoration:none;				
				font-weight:bold;
            }
            .letra14
            {

         		font-size:14px; 
				font-family:Arial; 
				color:#414141;
				text-decoration:none;				
				font-weight:bold;
            }

             .letra16
            {

         		font-size:16px; 
				font-family:Arial; 
				color:#414141;
				text-decoration:none;
				
				font-weight:bold;
            }
            .limta{
            	height: 70px;
            	width: 90px;


            }

            .linea_abajo
{
	            border:#000000;
	            width: 100%;
	            border-style:solid; 
	            border-top-width:0px; 
	            border-right-width:0px; 
	            border-bottom-width:1px; 
	            border-left-width:0px;

}
	         .linea_arriba{
	         	border:#000000;
	            width: 100%;
	            border-style:solid; 
	            border-top-width:2px; 
	            border-right-width:0px; 
	            border-bottom-width:0px; 
	            border-left-width:0px;



	         } 
	              .linea_derecha{
	         	border:#000000;
	            width: 100%;
	            border-style:solid; 
	            border-top-width:0px; 
	            border-right-width:2px; 
	            border-bottom-width:0px; 
	            border-left-width:0px;



	         } 
	           

            .title {
                font-size: 96px;
            }
            .p1{
               background-color: red;
            }
            .p2{
               background-color: blue;
            }
            .p3{
               background-color: green;
            }
            .t 
            {line-height: 100%;
            }
        </style>
</head>

<body>

<div class="row" style="margin-top: -30px;">
	
<div class="col-xs-1 limta" style="margin-left: -50px; margin-right: -25px; style=width: 750px;">

<img  class="limta" style="margin-left: -40px;" src="{{asset('img/IMTA.png')}}">
</div>

<div class="col-xs-10 " style="margin-right: -15px;">
<div class="" style="margin-left: -25px; ">
<center>
<h3 style="margin-top: -6px; margin-right:30px; ">INSTITUTO MEXICANO DE TECNOLOGÍA DEL AGUA</h3>
<br>
<h4 style="padding-top: -30px;">SUBDIRECCION DE INFORMÁTICA Y TELECOMUNICACIONES</h4>
<h4 style="padding-top: -12px; margin-bottom: -50px;">SOLICITUD DE SERVICIO DE TIC</h4>
</center>
</div>
</div>
<div class="col-xs-1 " style="margin-right: -10px;">	
<img  class="limta" style="margin-left: -55px;" src="{{asset('img/SEMARNAT.png')}}">


</div>

</div>
<hr class="linea_abajo" style="margin-top: -80px;  width: 100%;">

<table style="margin-top: 5px;">
	<tr>
		<td class="letra14" style="width:130px;">N° DE SOLICITUD:&nbsp;</td>
		<td class="borde2c letra16" style="width:80px;"><center>{{$solicitudes->id_solicitud_soporte}}</center></td>
		<td  style="width:167px;"></td>
		<td >Fecha y hora de la solicitud:&nbsp;</td>

		<td class="linea_abajo ">{{str_limit(($solicitudes->fecha_apertura),10,$end = ''). " a las ".fechahora($solicitudes->fecha_apertura)}}

 </td>

</table>
<table style="margin-left:-12px; width: 100%;">
	<tr>
		<td class="col-xs-12 letra14" >
			DATOS DEL RESGUARDANTE:
		</td>

	</tr>
</table>
<table>
	
	<tr>
		
		<td class="">Resguardante:&nbsp;</td>
		<td class="letra14 linea_abajo" style="width:300px;">{{$solicitudes->inventario->resguardante->nombre ." ".$solicitudes->inventario->resguardante->apellido_paterno ."
		".$solicitudes->inventario->resguardante->apellido_materno }}</td>
		<td class="" style="text-align: right; width:230px;">Ext:</td>
		<td class="letra14 linea_abajo" style=" text-align: center; width:100px;">{{$solicitudes->inventario->resguardante->extension}}</td>
	</tr>	
</table>

<table>
	<tr>		
		<td class="" style="width:10px;">Coordinación/ Subcoordinación:</td>
		<td class="linea_abajo" style="padding-top:20px;  width:600px;">{{$solicitudes->inventario->resguardante->subarea->area->area." / ".$solicitudes->inventario->resguardante->subarea->subarea}}</td>	
	</tr>
</table>
<table>
	<tr>		
		<td class="" style="width:200px;">En caso de que el nombre del resguardante no sea el solicitante del servicio, favor </td>
		</tr>
		<table>
		<tr class="">
			<td class="" style="width:100px;">de describir con atencion a:&nbsp;</td>
			<td class="letra14 linea_abajo " style="width:300px;">{{$solicitudes->usuario_atendido}}</td>			
		</tr>

</table>
</tr>
</table>


<table>
	<tr>
		<td class="letra14">Datos del equipo de cómputo / Telecomunicaciones / Telefonia</td>
	</tr>

</table>
<table>
		<tr>
	<td class="" style="width: 240px;">
		Núm. de inventario / Extensión / Núm:
	</td>
	<td class="borde1c letra14" style="width:90px;"><center>{{$solicitudes->inventario_id}}</center></td>
	<td class="" style="width:8px;"></td>
	<td class="" style="width:150px;">Descripcion del equipo:</td>
	<td class="borde1c" style="width:238px;">{{$solicitudes->inventario->descripcion}}</td>
	</tr>
</table>
<table style="margin-top: 5px;">
	
	<tr>
		<td class="" style="width:50px;">Memoria:&nbsp;</td>
		<td class="borde1c " style="width:80px;"> <center><!-- 128 GB --></center></td>
		<td class="" style="width:18px;"></td>
		<td class="" style="width:75px; padding-left:8px; ">Disco duro:</td>
		<td class="borde1c " style="width:90px;"><center><!--  1 TB --></center></td>
		<td class="" style="width:38px;"></td>
		<td class="" style="width:120px;">Sistema operativo:&nbsp;</td>
		<td class="borde1c " style="width:238px;"><!-- Windows XP --></td>
	</tr>
</table>

<table style="margin-top: 15px;">
	<tr>
		<td class="letra14">DATOS DE LA SOLICITUD DE SERVICIO</td>
	</tr>

</table>


<div class="row">
	
<div class="col-xs-2 " style="margin-left: -30px; padding-right: -10px; width:100px;">Servicio Solicitado:</div>
<div class="col-xs-4  borde1c" style="margin-left: -20px; padding-left: -3px;  width:200px;">{{$solicitudes->servicioSolicitado->servicio_solicitado}}</div>
<div class="col-xs-1 " style="margin-right:-32px;  width:5px"></div>
<div class="col-xs-1 " style="margin-right: -20px; text-align: right; width:150px;">Breve descripcion del servicio solicitado:</div>
<div class="col-xs-4 borde1c  " style="height:70px; margin-left: -5px; padding-left:-50px;  text-align:left; width:275px;">{{$solicitudes->falla_reportada}}</div>

</div>
<table style="margin-top: 10px;">
	<tr>
		<td class="" style="width:90px;">Diagnóstico / Solucion:</td>
		<td  class="contenedor " style="">
		<div class="" style="height: 185px; width:615px;">{{$solicitudes->diagnostico}}</div>	
		</td>
	</tr>
</table>


<!-- <div class="row">
	
<div class="col-xs-6  linea_arriba linea_derecha" style="width:332px;">
	<table>
		<tr>
			<td>Datos para se llenados por la mesa de servicio</td>
		</tr>
	</table>

	<div class="row">
		<div class="col-xs-5 p1" style="width: 150px;">Clasificación del servicio:</div>
		<div class="col-xs-5 p2" style="width: 150px;">Clasificación del servicio:</div>
	</div> -->







<!-- <table><tr>
	<td class="p1" style="padding-left: -22px; width:90px;">Clasificación del servicio:</td>
	<td style="width:0px;"></td>
	
	<td class="p2 borde1c" style="border-left: 20px; padding-left: 10px; width:170px;">Navegadores de Internet</td>
</tr></table> -->





<!-- </div>
<div class="col-xs-6 p2 linea_arriba" style=" margin-left:-15px;  width:333px;">
	<table>
		<tr>
			<td>Datos para se llenados por el usuario</td>
		</tr>
	</table>





</div>
</div> -->




<div class="row">   


<table class="linea_arriba" style="height: 320px;  margin-top: 2px;">
	<tr >
		<td  class="" style= " height: 250px; width:357.6px;"> <!-- td1 -->
				
		<!-- <table style="margin-top: 200px; width:100%;">
			<tr>
				<td class="p1" style="width:100px;">
					Tecnico que atiende:
				</td>
				<td class="p2" style="width:150px;">
					<div  class="borde1c" style="height: 18px;"></div>
				</td>
			</tr>
		</table>
 -->


                <div class="" style="margin-top: 1px;">
 				<table style="margin-bottom: 70px; width: 100%;">
 					<tr><td class=" letra14" style="width:361px;">Datos para ser llenados por la mesa de servicio:</td></tr>
 				</table>

 				<table style="margin-top: -60px; margin-bottom: 20px; width:100%;"><tr>
 					<td class="" style="width:140px;">Clasificación del servicio:</td>
 					<td class="" style="width:180px;"> <div style="height: 20px;" class="borde1c">
 						@if (!empty($solicitudes->subclasificacion_reparacion_id))
 					{{$solicitudes->subclasificacionReparacion->clasificacionReparacion->clasificacion_reparacion}}
                    @endif</div></td>
 				</tr></table>

 				<table style=" margin-top: -30px; margin-bottom: 20px; width:100%;"><tr>
 					<td class="" style="width:140px;">Tecnico que atiende:</td>
 					<td class="" style="width:180px;"><div class="borde1c">{{$solicitudes->tecnico->nombre}}</div></td>
 				</tr></table>



			<table class="" style="margin-top: -12px; width:100%">
				
				<tr>
					<td class="" style="width:90px;">Observaciones:</td>
					<td  style="width:190px;"><div style="height: 50px; text-align:justify; " class="borde1c t">{{$solicitudes->observaciones}}</div></td>

				</tr>
			</table>	


   			<table style="margin-top:5px; width:100%";>
   				<tr>
   					<td class="" style="width:20px;">Refacciones</td>
   					<td class="" style="width:210px;"></td>
   					<td class="" style="width: 40px;">Reemplazo</td>
   				</tr>
   			</table>


			<table style="width:100%;">
				<tr>
					<td  style=" width:10px;"> <div class="borde3">Cantidad</div></td>
					<td  style=" width:230px;"><div class="borde3si">Descripción</div></td>
					<td  style=" width:20px;"> <div class="borde3si">Si</div></td>
					<td  style=" width:10px;"><div class="borde3si">No</div></td>
				</tr>
				<tr>
					<td  style="  width:10px;"> <div class="borde3sti" style="height: 18px;"></div></td>
					<td  style=" width:230px;"><div class="borde3si borde3st" style="height: 18px;"></div></td>
					<td  style=" width:10px;"><div class="borde3si borde3st " style="height: 18px;"> <input type="radio" disabled="disabled" style="margin-top: -7px; margin-left: 2px;"></div></td>
					<td  style=" width:10px;"><div class="borde3si borde3st " style="height: 18px;"> <input type="radio" disabled="disabled" style="margin-top: -7px; margin-left: 2px;"></div></td>
				</tr>
			
			<tr>
					<td  style="  width:10px;"> <div class="borde3sti" style="height: 18px;"></div></td>
					<td  style=" width:230px;"><div class="borde3si borde3st" style="height: 18px;"></div></td>
					<td  style=" width:10px;"><div class="borde3si borde3st " style="height: 18px;"> <input type="radio" disabled="disabled" style="margin-top: -7px; margin-left: 2px;"></div></td>
					<td  style=" width:10px;"><div class="borde3si borde3st " style="height: 18px;"> <input type="radio" disabled="disabled" style="margin-top: -7px; margin-left: 2px;"></div></td>
				</tr>

			</table>

            <table style="margin-top:7px;  width:100%;">
				<tr>
					<td class="" style="width:100%;">Destino de las refacciones sustituidas:</td>
					
				</tr>
				<tr>
					<td class="" style="width:100%;">
					<div class=" linea_abajo" style="height: 18px;"></div>
					</td>
				</tr>
			</table>


			<table style="width:100%;  margin-top:18px; padding-bottom: 30px;">
 				<tr>
 					<td  class="" style="width:100%;"><center>FIRMA DEL TÉCNICO ESPECIALIZADO </center></td>
 				</tr>
 			</table>

 			<!-- <table class="" style="width:100%;   margin-bottom: 20px;">
 				<tr>
 					<td  class="" style="width:10px"></td>
 					<td  style="width:200px;"><div class="linea_abajo"></div></td>
 					<td class="" style="width:10px;"></td>
 				</tr>
 			</table> -->




			
			</div>

		</td>  <!-- td1 -->
			

		<!-- Estos dos TD sirven para poner la linea que divide  los daros que llena el usuario y la mesa de servicio -->

		<td  class=" linea_derecha" style=" height: 320px; width:2px;"></td>
		<td  class="" style="height: 250px; width:2px;"></td>

		<td  class="" style="height: 250px; width:356.1px;"> <!-- td2 -->
 
        

        <table class="" style="margin-top: 0px; margin-bottom: 21px;">
        	<tr>
        		<td class=" letra14" style="padding-bottom: 1px;">Datos para ser llenados por el usuario:</td>
        	</tr>
        	        	
        </table>

        <table style=" margin-top: -20px; padding-bottom: 2px;">
        	
        	<tr>
        		<td class="" style="width: 180px;">Fecha y hora en la que se presento el tecnico:</td>
        		<td class="" style=" width: 120px;"><div style="height: 20px;" class="borde1c"><center>{{str_limit(($solicitudes->fecha_atencion),10,$end = '')}}</center></div></td>
        		<td class="" style=" width: 80px;"><div style="height: 20px;" class="borde1c"><center>
        		{{hora($solicitudes->fecha_atencion)}}
        		</center></div></td>
        	</tr>
        	
        </table>

       


        <table>
        	
        	<tr>
        		<td class="" style="width: 185px;">conclusión del servicio:</td>
        		<td class="" style=" width: 122px;"><div style="height: 20px;" class="borde1c"><center>{{str_limit(($solicitudes->fecha_reparacion),10,$end = '')}}</center></div></td>
        		<td class="" style=" width: 80px;"><div style="height: 20px;" class="borde1c">
        		<center>{{hora($solicitudes->fecha_reparacion)}}</center>
        		</div></td>
        	</tr>
        	
        </table>
        

        <!-- EVALUACION DEL SERVICIO () -->
        <div class="visible-print-block">
		<table style="margin-bottom: 25px; width:100%">
			<tr>
				<td class="letra14">Evaluación del servicio:</td>
			</tr>
		</table>

		<table style="margin-top: -20px; width:100%" >
			<tr>
				<td class="">Satisfacción con la oportunidad del servicio</td>
				<td class="">Satisfacción con la solución implementada</td>
			</tr>
		</table>

		<table style="margin-top: 8px; width:100%;">
			<tr>
				<td class="t" style=" width:165px;">
				
					<table style="width:100%;">
						<tr> 
							<td class="" style="padding-left:10px;  width:80px;">Muy Bueno</td>
							<td class="" style="width:20px;"><input type="radio" disabled="disabled"></td>
						</tr>
							<tr> 
							<td class="" style="padding-left:10px;  width:80px;">Bueno</td>
							<td class="" style="width:20px;"><input type="radio" disabled="disabled"></td>
						</tr>
							<tr> 
							<td class="" style="padding-left:10px;  width:80px;">Regular</td>
							<td class="" style="width:20px;"><input type="radio" disabled="disabled"></td>
						</tr>
							<tr> 
							<td class="" style="padding-left:10px;  width:80px;">Malo</td>
							<td class="" style="width:20px;"><input type="radio" disabled="disabled"></td>
						</tr>
							<tr> 
							<td class="" style="padding-left:10px;  width:80px;">Muy Malo</td>
							<td class="" style="width:20px;"><input type="radio" disabled="disabled"></td>
						</tr>
					</table>


				</td>
				<td  class="" style=" width:175px;">
				
		

			<table style="width:100%;">
						<tr> 
							<td class="" style="padding-left:10px;  width:80px;">Muy Bueno</td>
							<td class="" style="width:20px;"><input type="radio" disabled="disabled"></td>
						</tr>
							<tr> 
							<td class="" style="padding-left:10px;  width:80px;">Bueno</td>
							<td class="" style="width:20px;"><input type="radio" disabled="disabled"></td>
						</tr>
							<tr> 
							<td class="" style="padding-left:10px;  width:80px;">Regular</td>
							<td class="" style="width:20px;"><input type="radio" disabled="disabled"></td>
						</tr>
							<tr> 
							<td class="" style="padding-left:10px;  width:80px;">Malo</td>
							<td class="" style="width:20px;"><input type="radio" disabled="disabled"></td>
						</tr>
							<tr> 
							<td class="" style="padding-left:10px;  width:80px;">Muy Malo</td>
							<td class="" style="width:20px;"><input type="radio" disabled="disabled"></td>
						</tr>
					</table>
			

				</td>
			</tr>
		</table>
 </div>
		<!-- EVALUACION DEL SERVICIO -->


</div>
        	<!-- Para poner el div que tiene la evaluacion del tecnico, se quita la clase que tiene el div y en el margin-top de la tabla que esta abajo de este comentario poner el valor "2", con esto ya queda alineado todo -->



 			<table style="width:100%;  margin-top:206px; padding-bottom: 30px;">
 				<tr>
 					<td  class="" style="width:100%;"><center>FIRMA DEL USUARIO </center></td>
 				</tr>
 			</table>

 			<!-- <table class="" style="width:100%;   margin-bottom: 0px;">
 				<tr>
 					<td  class="" style="width:10px"></td>
 					<td class="linea_abajo " style="width:200px;"></td>
 					<td class="" style="width:10px;"></td>
 				</tr>
 			</table> -->
 


		</td> <!-- td2 -->
	
		
	</tr>
</table>
</div>


<table class="" style="padding-top: 50px; margin-bottom: -80px; height: 20px;">
	<tr>
	    <td><div class="" style="width:10px;"></div></td>
		<td><div class="linea_arriba " style="border-left:15PX;  width:310px;"><center>{{$solicitudes->tecnico->nombre}}</center></div></td>

		<td><div class="" style="width:80px;"></div></td>
		<td><div class="linea_arriba " style="width:310px;"><center>{{$solicitudes->inventario->resguardante->nombre ." ".$solicitudes->inventario->resguardante->apellido_paterno ."
		".$solicitudes->inventario->resguardante->apellido_materno }}</center></div></td>
	</tr>
</table>


</body>
</html>

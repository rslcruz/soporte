<?php 


 if(!function_exists('fechahora')){
 	
 	function fechahora($fecha){
 		$hora= substr($fecha,11,8);
 		return $hora;

 	}

 }

  if(!function_exists('hora')){
 	
 	function hora($fecha){
 		$hora= substr($fecha,11,5);
 		return $hora;

 	}

 }
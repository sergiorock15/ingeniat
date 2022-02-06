<?php

class Conexion{

	public static function Conectar(){

		try{
			
			$conexion = new PDO('mysql:host=localhost; dbname=ingeniat', 'root', '');

			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$conexion->exec("SET CHARACTER SET utf8"); 									
						
			return $conexion;

		}catch(Exception $e){

			die('Error en la conexion: '. $e->getMessage() .'<br> en la linea: '. $e->getLine());

		}

	}

}

?>
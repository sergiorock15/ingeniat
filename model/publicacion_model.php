<?php

require_once '../vendor/autoload.php';
session_start();
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

	class Publicacion_model{

        private $conexion;
        public $registro;
        var $dblPublicacion = "";
        var $strTitulo = "";
        var $strDescripcion = "";
        var $datFecha = "";
        var $dblUsuario = "";
          
        public function __construct(){

			require_once('config/conexion.php');

			$this->conexion = Conexion::Conectar();
		}   

        //set_dblPublicacion
	    function set_dblPublicacion($par_dblPublicacion){
            $this->dblPublicacion = $par_dblPublicacion;
        }
	    function get_dblPublicacion(){
            return $this->dblPublicacion;
        }

        //set_strTitulo
	    function set_strTitulo($par_strTitulo){
            $this->strTitulo = $par_strTitulo;
        }
	    function get_strTitulo(){
            return $this->strTitulo;
        }

        //set_strDescripcion
	    function set_strDescripcion($par_strDescripcion){
            $this->strDescripcion = $par_strDescripcion;
        }
	    function get_strDescripcion(){
            return $this->strDescripcion;
        }

        //set_datFecha
        function set_datFecha($par_datFecha){
            $this->datFecha = $par_datFecha;
        }
        function get_datFecha(){
            return $this->datFecha;
        }

        //set_dblUsuario
        function set_dblUsuario($par_dblUsuario){
            $this->dblUsuario = $par_dblUsuario;
        }
        function get_dblUsuario(){
            return $this->dblUsuario;
        }                

        // ----   Metodos
		public function getPublicacion(){			
            
            try {
        
                // Decodificamos el token apartir de la sesion
                $jwt = $_SESSION['token'];
                $key = "example_key";
                $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
                // obtenemos el usuario y el rol al que pertenece
                $dblUsuario =$decoded->data->dblUsuario;
                $dblRol = intval($decoded->data->dblRol);              
                                
                //Consulta para verificar el login                                    
                $sql =  "                
                    SELECT 
                        t1.dblPublicacion as dblPublicacion,
                        t1.strTitulo as strTitulo,
                        t1.strDescripcion as strDescripcion,
                        t1.datFecha as datFecha,
                        t2.dblUsuario as dblUsuario,
                        concat(t2.strNombre,' ',t2.strApellido) as strFullName,
                        t3.strRol as strRol
                    FROM 
                        tblPublicacion t1
                    join 
                        tblusuario t2 ON 
                        t1.dblUsuario = t2.dblUsuario
                    join 
                        tblcatrol t3 ON 
                        t2.dblRol = t3.dblRol	                
                    WHERE
                        t2.dblUsuario = :dblUsuario
                ";	            

                // Preparamos la consulta
                $resultado = $this->conexion->prepare($sql);            
                $resultado->bindValue(":dblUsuario", $dblUsuario);            
                $resultado->execute();                        

                $this->registro = array();

                // Todos los roles menos Rol basico y medio alto
                if($dblRol == 1 || $dblRol == 3){
                    $this->registro = array();
                }  else {
                    while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){                
                        
                        $date=date_create($fila['datFecha']);                
                        $items['dblPublicacion']    = $fila['dblPublicacion'];
                        $items['strTitulo'] 		= $fila['strTitulo'];
                        $items['strDescripcion'] 	= $fila['strDescripcion'];								
                        $items['datFecha'] 		    = date_format($date,"d/m/Y");
                        $items['dblUsuario'] 		= $fila['dblUsuario'];				
                        $items['strNombre'] 		= $fila['strFullName'];
                        $items['strRol'] 		    = $fila['strRol'];
                        $items['strEditar'] 		= ($dblRol==5 || $dblRol==4) ?"<button class='btn btn-outline-primary' onClick='publicacion.showPublicacion(".$fila['dblPublicacion'].")' data-toggle='modal' data-target='#modalShowPublicacion'>Editar</button>":'';

                        $items['strEliminar'] 		= ($dblRol==5) ? "<button class='btn btn-outline-danger' onClick='publicacion.deletePublicacion(".$fila['dblPublicacion'].")'>Eliminar</button>":'';
                            
                        array_push($this->registro, $items);
                    } 
                }       
                
                $resultado->closeCursor();

                $this->conexion = null;

                return $this->registro;
            }catch (Exception $e) {                
                return $e->getMessage();
            }
		
		}		

        public function setPublicacion(){
			try {
                // Decodificamos el token apartir de la sesion
                $jwt = $_SESSION['token'];
                $key = "example_key";                
                // $key = "example_key1";                
                $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

                $dblUsuario =$decoded->data->dblUsuario;

                $strTitulo = $this->strTitulo;
                $strDescripcion = $this->strDescripcion;                        
                $datFecha = date("Y-m-d");
                $sql =  "
                    INSERT INTO 
                    tblPublicacion (
                        strTitulo,
                        strDescripcion, 			
                        datFecha, 
                        dblUsuario                        
                    ) VALUES (
                        :strTitulo,
                        :strDescripcion, 						 						
                        :datFecha, 
                        :dblUsuario                        
                )";

                $resultado = $this->conexion->prepare($sql);

                $resultado->bindValue(':strTitulo', $strTitulo);			
                $resultado->bindValue(':strDescripcion', $strDescripcion);			
                $resultado->bindValue(':datFecha', $datFecha);
                $resultado->bindValue(':dblUsuario', $dblUsuario);
                // $resultado->bindValue(':rol', $dblRol);

                $resultado->execute();

                $resultado->closeCursor();

                return 1;

                $this->conexion = null;
            } catch (Exception $e) {                
                return $e->getMessage();                                
            }
		
		}
        
        public function deletePublicacion(){
			
            $dblPublicacion = $this->dblPublicacion;			
            $sql =  "
                DELETE FROM 
                    tblPublicacion 
                WHERE 
                    dblPublicacion= :dblPublicacion";

			$resultado = $this->conexion->prepare($sql);

			$resultado->bindValue(':dblPublicacion', $dblPublicacion);						
			$resultado->execute();

			$resultado->closeCursor();

			$this->conexion = null;
		
		}
        
        public function showPublicacion(){			
            $dblPublicacion = $this->dblPublicacion;
            
            // Decodificamos el token apartir de la sesion
            $jwt = $_SESSION['token'];
            $key = "example_key";
            $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

            $dblUsuario =$decoded->data->dblUsuario;
                        
            //Consulta para ver la publicacion
            $sql =  "                
                SELECT 
                    t1.dblPublicacion as dblPublicacion,
                    t1.strTitulo as strTitulo,
                    t1.strDescripcion as strDescripcion,
                    t1.datFecha as datFecha,
                    t2.dblUsuario as dblUsuario,
                    concat(t2.strNombre,t2.strApellido) as strFullName,
                    t3.strRol as strRol
                FROM 
                    tblPublicacion t1
                join 
                    tblusuario t2 ON 
                    t1.dblUsuario = t2.dblUsuario
                join 
                    tblcatrol t3 ON 
                    t2.dblRol = t3.dblRol	                
                WHERE
                    t1.dblPublicacion = :dblPublicacion                
            ";	            

            // Preparamos la consulta
            $resultado = $this->conexion->prepare($sql);            
            $resultado->bindValue(":dblPublicacion", $dblPublicacion);            
            $resultado->execute();                        

            $this->registro = array();

			while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){                
                
                $date=date_create($fila['datFecha']);                
				$items['dblPublicacion']    = $fila['dblPublicacion'];
				$items['strTitulo'] 		= $fila['strTitulo'];
				$items['strDescripcion'] 	= $fila['strDescripcion'];												
				$items['dblUsuario'] 		= $fila['dblUsuario'];				
                $items['strNombre'] 		= $fila['strFullName'];
                $items['strRol'] 		    = $fila['strRol'];
                
                      
				array_push($this->registro, $items);
			}            
            
			$resultado->closeCursor();

			$this->conexion = null;

			return $this->registro;
		
		}

        public function UpdatePublicacion(){			                        


            $dblPublicacion = $this->dblPublicacion;
            $strTitulo = $this->strTitulo;
			$strDescripcion = $this->strDescripcion;                        
            $datFecha = date("Y-m-d");

            // Decodificamos el token apartir de la sesion
            $jwt = $_SESSION['token'];
            $key = "example_key";
            $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

            $dblUsuario =$decoded->data->dblUsuario;
                
            //Actualizamos la publicacion 
            $sql =  "
                UPDATE 
                    tblPublicacion
                SET 
                    strTitulo = :strTitulo, 
                    strDescripcion = :strDescripcion, 
                    datFecha = :datFecha, 
                    dblUsuario = :dblUsuario                    
                WHERE 
                    dblPublicacion = :dblPublicacion";            

			$resultado = $this->conexion->prepare($sql);

			$resultado->bindValue(':strTitulo', $strTitulo);			
			$resultado->bindValue(':strDescripcion', $strDescripcion);			
			$resultado->bindValue(':datFecha', $datFecha);
			$resultado->bindValue(':dblUsuario', $dblUsuario);            
            $resultado->bindValue(':dblPublicacion', $dblPublicacion);            

			$resultado->execute();

			$resultado->closeCursor();

			$this->conexion = null;
		
		}
        
        
		

	}

	




?>
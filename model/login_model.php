<?php

require_once '../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

	class login_model{

        private $conexion;
        var $strNombre = "";
        var $strApellido = "";
        var $strCorreo = "";
        var $strPassword = "";
        var $dblRol = "";
        
          

		public function __construct(){

			require_once('config/conexion.php');

			$this->conexion = Conexion::Conectar();
		}        

        //set_strNombre
	    function set_strNombre($par_strNombre){
            $this->strNombre = $par_strNombre;
        }
	    function get_strNombre(){
            return $this->strNombre;
        }

        //set_strApellido
	    function set_strApellido($par_strApellido){
            $this->strApellido = $par_strApellido;
        }
	    function get_strApellido(){
            return $this->strApellido;
        }

        //set_strCorreo
	    function set_strCorreo($par_strCorreo){
            $this->strCorreo = $par_strCorreo;
        }
	    function get_strCorreo(){
            return $this->strCorreo;
        }

        //set_strPassword
        function set_strPassword($par_strPassword){
            $this->strPassword = $par_strPassword;
        }
        function get_strPassword(){
            return $this->strPassword;
        }

        //set_dblRol
        function set_dblRol($par_dblRol){
            $this->dblRol = $par_dblRol;
        }
        function get_dblRol(){
            return $this->dblRol;
        }                

        // ----   Metodos

		public function entrar(){
			// Datos enviados
            $strCorreo = $this->strCorreo;
			$strPassword = $this->strPassword;
            
            //Consulta para verificar el login                                    
            $sql =  "
                SELECT 
                    t1.dblUsuario,						
                    t1.strNombre,
                    t1.strApellido,
                    t1.strCorreo,
                    t1.dblRol,
                    t2.strRol
                FROM 
                    tblusuario t1					
                JOIN
                    tblcatrol t2 ON
                    t1.dblRol = t2.dblRol
                WHERE
                    t1.strCorreo = :login
                AND 
                    t1.strPassword = :password
                LIMIT 1
            ";	

            $resultado = $this->conexion->prepare($sql);
            $resultado->bindValue(":login", $strCorreo);
            $resultado->bindValue(":password", $strPassword);
            $resultado->execute();            
            

            $num_registros = $resultado->rowCount();
            $usuario = $resultado->fetch(PDO::FETCH_ASSOC);
                        
            // Verificamos si existe el usuario
            if($num_registros != 0 ){                                                                                
                //  Generamos el token
                $key = "example_key";
                $time = time();
                $payload = array(
                    'iat' => $time, // Tiempo que inició el token
                    'exp' => $time + (60*60), // Tiempo que expirará el token (+1 hora)
                    'data' => [ // información del usuario
                        'dblUsuario' => $usuario['dblUsuario'],
                        'strNombre' => $usuario['strNombre'],
                        'strApellido' => $usuario['strApellido'],
                        'strCorreo' => $usuario['strCorreo'],
                        'dblRol' => $usuario['dblRol'],
                        'strRol' => $usuario['strRol'],
                    ]
                );
                            
                $jwt = JWT::encode($payload, $key, 'HS256');                                            
                session_start();
                $_SESSION['usuario'] = $strCorreo;                
                $_SESSION['strRol'] = $usuario['strRol'];                
                
                $_SESSION['token'] = $jwt;
                echo 0;
            }else {
                echo 1;
            }

			$resultado->closeCursor();

			$this->conexion = null;			
		
		}		

        public function registrarse(){
			
            $strNombre = $this->strNombre;
			$strApellido = $this->strApellido;
            $strCorreo = $this->strCorreo;
			$strPassword = $this->strPassword;
            $dblRol = $this->dblRol;         
                                    
            $sql =  "
				INSERT INTO 
                    tblusuario (
						strNombre,
						strApellido, 			
						strCorreo, 
						strPassword,
                        dblRol
					) VALUES (
						:nombre,
						:apellido, 						 						
						:correo, 
						:password,
                        :rol
					)";

			$resultado = $this->conexion->prepare($sql);

			$resultado->bindValue(':nombre', $strNombre);			
			$resultado->bindValue(':apellido', $strApellido);			
			$resultado->bindValue(':correo', $strCorreo);
			$resultado->bindValue(':password', $strPassword);
            $resultado->bindValue(':rol', $dblRol);

			$resultado->execute();

			$resultado->closeCursor();

			$this->conexion = null;
		
		}		
		

	}

	




?>
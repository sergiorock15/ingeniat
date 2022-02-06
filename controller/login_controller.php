<?php


    if(isset($_POST['seccion']) AND !empty($_POST['seccion'])){
		$seccion = $_POST['seccion'];
	} else {
		$seccion = '';
	}	

	switch ($seccion) {
		case 'entrar':

			if(isset($_POST['strCorreo']) AND !empty($_POST['strCorreo'])){
				$strCorreo = htmlentities(addslashes($_POST['strCorreo']));
			} else {				
				return 0;				
			}

            if(isset($_POST['strPassword']) AND !empty($_POST['strPassword'])){
				$strPassword = htmlentities(addslashes($_POST['strPassword']));
			} else {				
				return 0;				
			}                         

            require_once('../model/login_model.php');

            $iniciarSesion = new login_model();            
            $iniciarSesion->set_strCorreo($strCorreo);
            $iniciarSesion->set_strPassword($strPassword);
            $iniciarSesion->entrar();

            break;

        case 'registrar':
            
                if(isset($_POST['strNombre']) AND !empty($_POST['strNombre'])){
                    $strNombre = htmlentities(addslashes($_POST['strNombre']));
                } else {				
                    return 0;				
                }

                if(isset($_POST['strApellido']) AND !empty($_POST['strApellido'])){
                    $strApellido = htmlentities(addslashes($_POST['strApellido']));
                } else {				
                    return 0;				
                }

                if(isset($_POST['strCorreo']) AND !empty($_POST['strCorreo'])){
                    $strCorreo = htmlentities(addslashes($_POST['strCorreo']));
                } else {				
                    return 0;				
                }
    
                if(isset($_POST['strPassword']) AND !empty($_POST['strPassword'])){
                    $strPassword = htmlentities(addslashes($_POST['strPassword']));
                } else {				
                    return 0;				
                }  

                if(isset($_POST['cmbRol']) AND !empty($_POST['cmbRol'])){
                    $dblRol = $_POST['cmbRol'];
                } else {				
                    return 0;				
                }  
                
                
    
                require_once('../model/login_model.php');
    
                $iniciarSesion = new login_model();            
                $iniciarSesion->set_strNombre($strNombre);
                $iniciarSesion->set_strApellido($strApellido);
                $iniciarSesion->set_strCorreo($strCorreo);
                $iniciarSesion->set_strPassword($strPassword);
                $iniciarSesion->set_dblRol($dblRol);

                $iniciarSesion->registrarse();

                echo '1';

			    break;
            		
		
		
        default : 

		    break;
	}
?>

<?php

	if(isset($_POST['seccion']) AND !empty($_POST['seccion'])){
		$seccion = $_POST['seccion'];
	} else {
		$seccion = '';
	}	

    // Eliminar
    if($_SERVER['REQUEST_METHOD'] === "DELETE"){        
        parse_str(file_get_contents("php://input"),$post_vars);        
        if(isset($post_vars['seccion']) AND !empty($post_vars['seccion'])){
            $seccion = $post_vars['seccion'];            
        } else {
            $seccion = '';
        }        
    }
    
    // Editar
    if($_SERVER['REQUEST_METHOD'] === "PUT"){        
        parse_str(file_get_contents("php://input"),$post_vars);            
        if(isset($post_vars['seccion']) AND !empty($post_vars['seccion'])){
            $seccion = $post_vars['seccion'];            
        } else {
            $seccion = '';
        }        
    }
    
	switch ($seccion) {
		case 'getPublicacion':

			require_once('../model/publicacion_model.php');
		
			$publicacion = new Publicacion_model();

			$resultado = $publicacion->getPublicacion();

			header('Content-Type: application/json');

			echo json_encode($resultado, JSON_PRETTY_PRINT);

			break;

		case 'setPublicacion':

			if(isset($_POST['strTitulo']) AND !empty($_POST['strTitulo'])){
				$strTitulo = htmlentities(addslashes($_POST['strTitulo']));
			} else {				
				return 0;				
			}
			
			if(isset($_POST['strDescripcion']) AND !empty($_POST['strDescripcion'])){
				$strDescripcion = htmlentities(addslashes($_POST['strDescripcion']));
			} else {				
				return 0;
			}		

            require_once('../model/publicacion_model.php');
		
			$publicacion = new Publicacion_model();
			         
            $publicacion->set_strTitulo($strTitulo);
            $publicacion->set_strDescripcion($strDescripcion);
            
            $resultado = $publicacion->setPublicacion();

			header('Content-Type: application/json');

			echo json_encode($resultado, JSON_PRETTY_PRINT);

			break;
		
		case 'deletePublicacion':

			parse_str(file_get_contents("php://input"),$post_vars);        
            if(isset($post_vars['dblPublicacion']) AND !empty($post_vars['dblPublicacion'])){
                $dblPublicacion = $post_vars['dblPublicacion'];                
            } else {
                return 0;
            }                        

            require_once('../model/publicacion_model.php');
		
			$publicacion = new Publicacion_model();			         
            $publicacion->set_dblPublicacion($dblPublicacion);            
            $publicacion->deletePublicacion();

			echo '1';

			break;
        case 'showPublicacion':

            if(isset($_POST['dblPublicacion']) AND !empty($_POST['dblPublicacion'])){
				$dblPublicacion = $_POST['dblPublicacion'];
			} else {				
				return 0;
			}		

            require_once('../model/publicacion_model.php');
		
			$publicacion = new Publicacion_model();			         
            $publicacion->set_dblPublicacion($dblPublicacion);                        
            $resultado = $publicacion->showPublicacion();

            header('Content-Type: application/json');

			echo json_encode($resultado, JSON_PRETTY_PRINT);
			

			break;
        case 'UpdatePublicacion':

            parse_str(file_get_contents("php://input"),$post_vars);        
            if(isset($post_vars['dblPublicacion']) AND !empty($post_vars['dblPublicacion'])){
                $dblPublicacion = $post_vars['dblPublicacion'];                
            } else {
                return 0;
            }

            parse_str(file_get_contents("php://input"),$post_vars);        
            if(isset($post_vars['strTitulo']) AND !empty($post_vars['strTitulo'])){
                $strTitulo = $post_vars['strTitulo'];                
            } else {
                return 0;
            }

            parse_str(file_get_contents("php://input"),$post_vars);        
            if(isset($post_vars['strDescripcion']) AND !empty($post_vars['strDescripcion'])){
                $strDescripcion = $post_vars['strDescripcion'];                
            } else {
                return 0;
            }                        
            
            require_once('../model/publicacion_model.php');
            
            $publicacion = new Publicacion_model();
                         
            $publicacion->set_dblPublicacion($dblPublicacion);
            $publicacion->set_strTitulo($strTitulo);
            $publicacion->set_strDescripcion($strDescripcion);
                
            $publicacion->UpdatePublicacion();
    
            echo '1';
    
            break;
        default : 
    		break;


	}



	



?>
<?php
    session_start();

    
    if(!isset($_SESSION['usuario'])){
        header('Location: ../index.php');            
    }

    require_once '../vendor/autoload.php';
    session_start();
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    // Decodificamos el token apartir de la sesion
    $jwt = $_SESSION['token'];
    $key = "example_key";
    $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
    // obtenemos el usuario y el rol al que pertenece
    $dblUsuario =$decoded->data->dblUsuario;
    $dblRol = intval($decoded->data->dblRol);    
    $strRol = intval($decoded->data->strRol);    
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <!-- Bootstrap CSS -->    
    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.css">

    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Sweet alert -->
    <title>Ingeniat</title>            
  </head>
  <body>
    
    <!-- Menu -->
    <?php
        require('components/menu.php');
    ?>

    
<section class="container-fluid my-5">
      <div class="row">
        <div class="col-md-4">
          <div class="row px-5">
            <div class="col-md-12 bg-light border border-dark">

              <div class="row justify-content-center text-center">
                <div class="col-md-8">  
                  <h2 >Agregar</h2>
                </div>

                <div id="errorCampo"></div>                

                <div class="col-md-8">
                  <div class="form-group">                    
                    <label for="Sku">Titulo:</label>
                    <input type="text" name="strTitulo" id="strTitulo" placeholder="Titulo" class="form-control">
                  </div>
                </div>

                <div class="col-md-8">
                  <div class="form-group">
                    <label for="nombre">Descripcion:</label>
                    <textarea class="form-control" id="strDescripcion" name="strDescripcion" rows="3" placeholder="Descripción"></textarea>
                  </div>
                </div>                                                                         

              </div>

              <div class="row justify-content-center">
                <div class="col-md-6">
                  <div class="form-group">
                    <button type="button" class="btn btn-outline-primary btn-block" id='guardar' onclick="publicacion.setPublicacion()" >Agregar</button>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="col-md-8 px-5">
        <div class="row">
            <div class="col-12">                
                <div class="alert alert-info text-center" role="alert">
                    <h3> Publicaciones </h3>
                </div>
            </div>
        </div>
          <table class="table table-striped table-hover table-bordered" id="tablaPublicacion">
            <thead>
              <tr>
                  <th data-field="dblPublicacion"># Publicación</th> 
                  <th data-field="strTitulo">Titulo</th>
                  <th data-field="strDescripcion">Descripcion</th>                  
                  <th data-field="strNombre">Nombre</th>
                  <th data-field="datFecha">Fecha</th>
                  <th data-field="strRol">Rol</th>
                  <th data-field="strEditar">Editar</th>
                  <th data-field="strEliminar">Eliminar</th>                                                          

                  



              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

        </div>
      


    </section>
    <!-- Optional JavaScript; choose one of the two! -->    

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.js"></script>

    <script src="publicacion.js"></script> 
    <script>      
        // Variable global de roles
        var rol = <?php echo $dblRol;?>;

        $(document).ready(function(){

          
          publicacion.init();
        }); 
    </script>

    <!-- Modales -->
    <div id="modalShowPublicacion" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">     
          <div class="modal-header">
            <h5 class="modal-title">Mostrar Publicacion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modalShowPublicacionBody" class="row">             
            
          </div>
          <div class="modal-footer">        
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" data-dismiss="modal" onClick="publicacion.UpdatePublicacion();">Actualizar</button>
          </div>
        </div>
      </div>
    </div>

    
    
  </body>
</html>
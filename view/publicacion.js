publicacion = function(){

    return{
    
        getPublicacion: function(){      
            var $tablaPublicacion = $('#tablaPublicacion');
            $tablaPublicacion.bootstrapTable('destroy');                                                    

            datos = {
                seccion: 'getPublicacion'
            }

            $.ajax({
                type: 'POST',
                url: '../controller/publicacion_controller.php',
                data: datos,
                success: function(resp){                    

                    console.log(resp);
                    if(resp=="Signature verification failed"){                        
                        Swal.fire({
                            title: 'Surgio un error en tu autentificacion',                        
                            confirmButtonText: 'Ok',                        
                        }).then((result) => {                                                    
                            location.replace("../cerrarSesion.php");                            
                        })                        
                    }
                    if(resp=="Expired token"){
                        Swal.fire({
                            title: 'El tiempo de expiración a caducado',                        
                            confirmButtonText: 'Ok',                        
                        }).then((result) => {                                                    
                            location.replace("../cerrarSesion.php");                            
                        })                           
                    }

                    
                    
                    
                    $tablaPublicacion.bootstrapTable({                    
                        data: resp,
                        exportDataType: 'all'
                    })

                    $tablaPublicacion.bootstrapTable('refresh');                    
                    // Excluimos a los roles 1 y 2
                    if(rol == 1 || rol == 2){
                        $("#guardar").prop('disabled', true);                        
                    } else {                        
                    }
                                      
                }
            });
            
                            
        },

        setPublicacion : function(){            

            var strTitulo       = $('#strTitulo').val();
            var strDescripcion  = $('#strDescripcion').val();

            if(strTitulo == "" || strTitulo == null){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Verifique que el Titulo no este vacio!',
                })
                return false;
            }

            if(strDescripcion == "" || strDescripcion == null){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Verifique que la Descripcion no este vacio!',                              
                });
                return false;
            }

            var datos = {
                seccion         : 'setPublicacion',
                strTitulo       : strTitulo,
                strDescripcion  : strDescripcion
            }            
                        
            $.ajax({
                type: 'POST',
                url: '../controller/publicacion_controller.php',
                data: datos,
                success: function(resp){
                    
                    if(resp == '1'){                        
                        Swal.fire(
                            'Operacion Exitosa!',
                            'La publicación se Agrego Correctamente!',
                            'success'
                        );
                        
                        $('#strTitulo').val('');
                        $('#strDescripcion').val('');                                                                                            
                        publicacion.getPublicacion();
                    } else if (resp == "Signature verification failed") {
                        Swal.fire({
                            title: 'Surgio un error en tu autentificacion',                        
                            confirmButtonText: 'Ok',                        
                        }).then((result) => {                                                    
                            location.replace("../cerrarSesion.php");                            
                        })    
                        
                    }else if (resp == "Expired token") {
                        Swal.fire({
                            title: 'Surgio un error en tu autentificacion',                        
                            confirmButtonText: 'Ok',                        
                        }).then((result) => {                                                    
                            location.replace("../cerrarSesion.php");                            
                        })    
                        
                    } 
                    else {                    
                        Swal.fire(
                            'Error',
                            'Error al insertar los datos!',
                            'error'
                        );                        
                    }

                                        
                }
            });
        }, 
        
        deletePublicacion : function(dblPublicacion){                        
            var datos = {
                seccion         : 'deletePublicacion',
                dblPublicacion       : dblPublicacion,                
            }       
            $.ajax({
                url: '../controller/publicacion_controller.php',
                type: 'DELETE',
                contentType: 'application/json',                
                data: datos,
                success: function(resp){
                    console.log(resp);
                    if(resp == '1'){
                        Swal.fire(
                            'Operacion Exitosa!',
                            'La publicación se Agrego Correctamente!',
                            'success'
                        );
                        publicacion.getPublicacion();

                    } else {
                        Swal.fire(
                            'Error',
                            'Error al guardar la publicación!',
                            'error'
                        );      
                        publicacion.getPublicacion();
                    }
                }
            });     
                                    
        }, 
        
        showPublicacion: function(dblPublicacion){                  
            datos = {
                seccion: 'showPublicacion',
                dblPublicacion       : dblPublicacion,   
            }

            $.ajax({
                type: 'POST',
                url: '../controller/publicacion_controller.php',
                data: datos,
                success: function(resp){                    
                    console.log(resp);
                    var codigoModal = ``; 
                    resp.forEach(element => {
                        codigoModal += `
                        <div class="row justify-content-center text-center">                                           
                            <div class="col-md-8">
                                <div class="form-group">                    
                                    <label for="strEditTitulo">Titulo</label>
                                    <input type="text" name="strEditTitulo" id="strEditTitulo" class="form-control" value="`+element.strTitulo+`">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="strEditDescripcion">Descripcion</label>
                                    <textarea class="form-control" id="strEditDescripcion" name="strEditDescripcion" rows="3">`+element.strDescripcion+`</textarea>
                                </div>
                            </div>    
                            <input type="hidden" name="dblEditPublicacion" id="dblEditPublicacion" placeholder="Titulo" class="form-control" value="`+element.dblPublicacion+`">                                                                     
                        </div>
                        `;
                        
                    });
                    $("#modalShowPublicacionBody").html(codigoModal);
                                      
                }
            });
            
                            
        },

        UpdatePublicacion : function(){            

            var strTitulo       = $('#strEditTitulo').val();
            var strDescripcion  = $('#strEditDescripcion').val();
            var dblPublicacion  = $('#dblEditPublicacion').val();
            

            if(strTitulo == "" || strTitulo == null){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Verifique que el Titulo no este vacio!',
                })
                return false;
            }

            if(strDescripcion == "" || strDescripcion == null){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Verifique que la Descripcion no este vacio!',                              
                });
                return false;
            }

            var datos = {
                seccion         : 'UpdatePublicacion',
                dblPublicacion  : dblPublicacion,
                strTitulo       : strTitulo,
                strDescripcion  : strDescripcion,
            }                                   
                        
            $.ajax({                
                type: 'PUT',
                contentType: 'application/json', 
                url: '../controller/publicacion_controller.php',
                data: datos,
                success: function(resp){
                    console.log(resp);
                    if(resp == '1'){                        
                        Swal.fire(
                            'Operacion Exitosa!',
                            'La publicación se actualizo Correctamente!',
                            'success'
                        );                                                
                        publicacion.getPublicacion();
                    } else {                    
                        Swal.fire(
                            'Error',
                            'Error al actualizar los datos!',
                            'error'
                        );                        
                    }

                                        
                }
            });
        }, 
      
        init: function(){              
            publicacion.getPublicacion();
        },

    }

  }();
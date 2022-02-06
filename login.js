iniciarSesion = function(){

    return{         

        entrar : function(){   
            let strCorreo  = $("#strCorreo").val();
            let strPassword = $("#strPassword").val();
                        
            if(strCorreo == "" || strCorreo == null || strPassword == "" || strPassword == null){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Verifica que los campos esten llenados completamente!',                
                })
            }

            var data = {
                seccion     : 'entrar',                                                
                strCorreo       : strCorreo,
                strPassword    : strPassword                
            }            

            $.ajax({
                type: 'POST',
                url: 'controller/login_controller.php',
                data: data,
                success: function(resp){                                        
                    console.log(typeof (resp));
                    console.log(resp);
                    if(resp == '0'){
                        Swal.fire(
                            'Bienvenido!',
                            'Has iniciado sesión correctamente! '+strCorreo+'.',
                            'success'
                        );
                        location.replace("view/publicacion.php");
                    }else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Contraseña incorrecta',                
                        })
                    }
                }
            });

        }, 
        
        registrarse : function(){   
            let strNombre = $("#strNombre").val();
            let strApellido = $("#strApellido").val();
            let strCorreo = $("#strCorreo").val();
            let strpassword = $("#strpassword").val();
            let cmbRol = $( "#cmbRol option:selected" ).val();                        
            
            if(strNombre == "" || strNombre == null){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Verifica que el campo nombre este llene!',                
                })
                return false;
            }

            if(strApellido == "" || strApellido == null){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Verifica que el campo apellido este llene!',                
                });
                return false;
            }

            if(strCorreo == "" || strCorreo == null){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Verifica que el campo correo este llene!',                
                });
                return false;
            }

            if(strpassword == "" || strpassword == null){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Verifica que el campo contraseña este llene!',                
                });
                return false;
            }
            

            var data = {
                seccion     : 'registrar',                                                
                strNombre   : strNombre,
                strApellido : strApellido,
                strCorreo   : strCorreo,
                strPassword : strpassword,
                cmbRol : cmbRol,
            }            

            $.ajax({
                type: 'POST',
                url: 'controller/login_controller.php',
                data: data,
                success: function(resp){                     
                    if(resp == '1'){
                        Swal.fire(
                            'Bienvenido!',
                            'Te Has registrado correctamente',
                            'success'
                        )
                        location.replace("index.php");
                    }else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Algo salio mal',                
                        })
                    }
                }
            });

        },
            
        init: function(){              
           console.log("log in");
        },


    }

}();
<?php
require_once('model/config/conexion.php');
$conexion = Conexion::Conectar();
?>





<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->    
    <link href="login.css" rel="stylesheet"/>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.css">

    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Sweet alert -->
    <title>Ingeniat</title>    


    
    
  </head>
  <body>
    <!-- <h1>Ingeniat</h1> -->

    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="images/logo_ingeniat.jpg" id="icon" alt="User Icon" style="width:25%;" class="m-4"/>
            </div>

            <!-- Login Form -->
            <form>
                <div>
                <input type="text" id="strNombre" class="fadeIn second" name="strNombre" placeholder="Nombre">
                <input type="text" id="strApellido" class="fadeIn second" name="strApellido" placeholder="Apellido">
                <input type="text" id="strCorreo" class="fadeIn second" name="strCorreo" placeholder="Correo">
                <input type="password" id="strpassword" class="fadeIn third" name="strpassword" placeholder="Contraseña">                
                <div class="row justify-content-center mt-2">
                <select class="form-control campoSelect" id="cmbRol">
                    <?php
                        $sql =  "SELECT t1.dblRol, t1.strRol FROM tblCatRol t1 ";	
                        $resultado = $conexion->prepare($sql);
                        $resultado->execute();   
                        while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
                    ?>
                        <option value="<?php echo $row['dblRol']; ?>"><?php echo $row['strRol']; ?></option>
                    <?php
                        }
                        $resultado->closeCursor();
                    ?>                        
                </select>
                    </div>
                <input type="button" class="fadeIn fourth" value="Registrarse!" onClick="iniciarSesion.registrarse()">
                
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="index.php" >Iniciar Sesion</a>
            </div>

        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->    

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.js"></script>

    <script src="login.js"></script> 
    <script>      
        $(document).ready(function(){
            iniciarSesion.init();
        }); 
    </script>
    
    
  </body>
</html>
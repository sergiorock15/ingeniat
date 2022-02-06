<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><?php echo $_SESSION['strRol'];?></a>
                    </li>            
                    <li class="nav-item active">
                        <!-- <a class="nav-link" href="#"><?php echo $_SESSION['strRol'];?></a> -->
                    </li>            
                    <li class="nav-item active">
                        <!-- <a class="nav-link" href="#"><?php echo $_SESSION['strRol'];?></a> -->
                    </li>            
                    <li class="nav-item active">
                        <!-- <a class="nav-link" href="#"><?php echo $_SESSION['strRol'];?></a> -->
                    </li>            
                
                
                    <li class="nav-item active text-center">
                        <a class="nav-link" href="#"><?php echo $_SESSION['usuario'];?></a>
                    </li>    
                
            </div>        
            
        </ul>
    </div>

    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="../cerrarSesion.php">Cerrar Sesión</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    
</nav>
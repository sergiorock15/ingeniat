<?php
        session_start();
        if(!isset($_SESSION['usuario'])){
            header('Location: ../index.php');
        }
?>
<!doctype html>
<html lang="en">
  <head>
            
  </head>
  <body>    
    <?php
        session_start();
        session_destroy();
        header('Location: index.php');
    ?>
    
  </body>
</html>
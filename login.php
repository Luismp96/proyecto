<?php 
    session_start();
    include "log.php";
?>
<!DOCTYPE html>

<html lang="es">

    <head>
        <title>Panel de Control</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/estilos.css">
    </head>
    <body>
        <main>
            <?php

            include "config.php";

            $peticion = "SELECT * FROM administradores WHERE usuario = '".$_POST['usuario']."' AND contrasena = '".$_POST['contrasena']."' ";
            $resultado = mysqli_query($conexion,$peticion);

            if($fila = mysqli_fetch_assoc($resultado)){
                $_SESSION['usuario'] = $fila['usuario'];
                echo "
                    <div class='correcto'>V</div>
                    <br><br>
                    <p>Usuario correcto.<br><br>Registrando Acceso Correcto en el Sistema. Entrando panel de control..</p>

                ";
                //REDIRIGIMOS A PANELDECONTROL.PHP
                echo "<meta http-equiv='refresh' content='5;     url=paneldecontrol.php'>";
            }else{
                echo "
                    <div class='incorrecto'>X</div>
                    <br><br>
                    <p>Usuario incorrecto.<br><br>Registrando Acceso Incorrecto en el Sistema. Redirigiendo en 5s</p>

                ";
                //REDIRIGIMOS A INDEX.PHP
                echo "<meta http-equiv='refresh' content='5;     url=index.php'>";
            }

            ?>

        </main>
    </body>


</html>





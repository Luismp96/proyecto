<?php
    session_start();
    include "log.php";
    include "config.php";
    include "./inc/funciones.php";

    if(isset($_GET['accion'])){
        switch ($_GET['accion']){
            case "insertar":
                insertarRegistro($conexion);
                break;
            //P4 INICIO
            case "eliminar":
                eliminarRegistro($conexion);
                break;
            case "actualizar":
                actualizarRegistro($conexion);
                break;
            case "borrartodo":
                borrartodo($conexion);
                break;
            //P4 FIN
        }
    }
?>

<!DOCTYPE html>

<html lang="es">

    <head>
        <title>Panel de Control</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/panel.css">
    </head>
    <body>

        <?php
           comprobarAcceso();
        ?>

        <header style="text-align:center">
            <h1>PANEL DE CONTROL</h1>
        </header>
        <main>
            <nav>
                <ul>
                    <?php
                        menuNavegacion($conexion);
                    ?>
                </ul>
            </nav>
            <section>

                <?php
                    mostrarNombreTabla();
                ?>
                
                <div id='contenedor'>

                    <?php
                        if(!isset($_GET['operacion'])){
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <?php
                                    mostrarCabecera($conexion);
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                mostrarDatos($conexion);
                            ?>
                        </tbody>
                    </table>
                    <?php

                        }else{
                            switch($_GET['operacion']){
                                case "nuevo":
                                    formularioInsertar($conexion);
                                    break;
                                case "actualizar":
                                    formularioActualizar($conexion);
                                    break;
                            }
                        }
                    ?>
                </div>
                <?php
                    
   

                ?>
                
            </section>
        </main>
        
    </body>


</html>
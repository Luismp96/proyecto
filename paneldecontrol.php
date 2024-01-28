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
                <a href="?operacion=nuevo&tabla=<?php echo $_GET['tabla'] ?>" class="boton nuevo">AÑADIR</a>

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
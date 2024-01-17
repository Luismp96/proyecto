<?php
    session_start();
    include "log.php";
    include "config.php";
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
            if(!isset($_SESSION['usuario'])){
                die("<aside><div class='incorrecto'>X</div>Intento Incorrecto</aside>");
            }
           
        ?>

        <header style="text-align:center">
            <h1>PANEL DE CONTROL</h1>
        </header>
        <main>
            <nav>
                <ul>
                    <?php
                        $peticion = "SHOW TABLES;";
                        $resultado = mysqli_query($conexion,$peticion);
        
                        while($fila = mysqli_fetch_assoc($resultado)){
                            echo "<li>
                                    <a href='?tabla=".$fila['Tables_in_proyecto']."'>".$fila['Tables_in_proyecto']."
                                    </a>
                            </li>";
                        }
                    ?>
                </ul>
            </nav>
            <section>
                <?php
                    if(isset($_GET['tabla'])){

                        echo "<p style='color:black; text-align:center;padding-bottom:10px'><b>TABLA: </b>".$_GET['tabla']."</p>";
                        echo "<div id='contenedor'>";

                        $contador = 0;
                        $peticion = "SHOW COLUMNS FROM " . $_GET['tabla'] . ";";
                        $resultado = mysqli_query($conexion,$peticion);

                        echo "<table>";
                        echo "<thead>";
                        echo "<tr>";
                        
                        while($fila = mysqli_fetch_assoc($resultado)){
                            echo "<th>" .$fila['Field']."</th>";
                        }
                        echo "</tr>";
                        echo "</thead>";

                        $peticion = "SELECT * FROM " . $_GET['tabla'] . ";";
                        $resultado = mysqli_query($conexion,$peticion);

                        while($fila = mysqli_fetch_assoc($resultado)){
                            echo "<tr>";
                            $contador = 0;
                            $id = 0;
                            foreach($fila as $registro){
                                echo "<td>" .$registro."</td>";
                                if($contador == 0){
                                $id = $registro;
                                }
                            $contador++;
                            }
                            echo"</tr>";
                        }
                        echo "</table>";
                        echo "</div>";

                    }

                ?>
                
                <!--<div id="contenedor">
                    <table>

                        <thead>
                            <tr>
                                <th>Atributo 1</th>
                                <th>Atributo 2</th>
                                <th>Atributo 3</th>
                                <th>Atributo 4</th>
                            </tr>    

                        </thead>    
                        <tbody>
                            <tr>
                                <td>Registro 1 [1]</td>
                                <td>Registro 1 [2]</td>
                                <td>Registro 1 [3]</td>
                                <td>Registro 1 [4]</td>
                            </tr>
                            <tr>
                                <td>Registro 2 [1]</td>
                                <td>Registro 2 [2]</td>
                                <td>Registro 2 [3]</td>
                                <td>Registro 2 [4]</td>
                            </tr>
                            <tr>
                                <td>Registro 3 [1]</td>
                                <td>Registro 3 [2]</td>
                                <td>Registro 3 [3]</td>
                                <td>Registro 3 [4]</td>
                            </tr>
                            
                        </tbody>    
                            
                    </table>
                </div>

                -->
            </section>
        </main>
        
    </body>


</html>
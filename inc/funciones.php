<?php

    //COMPROBAMOS QUE HAYA REGISTRADO UN USUARIO 
    function comprobarAcceso(){

        if(!isset($_SESSION['usuario'])){
            die("<aside><div class='incorrecto'>X</div>Intento Incorrecto</aside>");
        }
    }

    //MENU DE NAVEGACION: TABLAS DEL PROYECTO
    function menuNavegacion($conexion){

        $peticion = "SHOW TABLES;";
        $resultado = mysqli_query($conexion,$peticion);
        
        while($fila = mysqli_fetch_assoc($resultado)){
            echo "<li>
                <a href='?tabla=".$fila['Tables_in_proyecto']."'>".$fila['Tables_in_proyecto']."
                </a>
            </li>";
        }
    }

    //FUNCION PARA MOSTRAR EL NOMBRE DE LAS COLUMNAS DE LA TABLA COMO CABECERA
    function mostrarCabecera($conexion){

        if(isset($_GET['tabla'])){
            $peticion = "SHOW COLUMNS FROM " . $_GET['tabla'] . ";";
            $resultado = mysqli_query($conexion,$peticion);
            
            while($fila = mysqli_fetch_assoc($resultado)){
                echo "<th>" .$fila['Field']."</th>";
            }

            echo "<th>
                        Operaciones
                </th>";
            echo"</tr>";
        }
       
    }

    //FUNCION PARA MOSTRAR NOMBRE DE LA TABLA AL SER SELECCIONADA
    function mostrarNombreTabla(){
        if(isset($_GET['tabla'])){

            echo "<p style='color:black; text-align:center;padding-bottom:10px'><b>TABLA: </b>".$_GET['tabla']."</p>";
            echo "";
        }
    }

    //FUNCION PARA MOSTRAR EL CONTENIDO DE CADA UNA DE LAS TABLAS CUANDO ES SELECCIONADA
    function mostrarDatos($conexion){
        if(isset($_GET['tabla'])){

            $peticion = "SELECT * FROM " . $_GET['tabla'] . ";";
            $resultado = mysqli_query($conexion,$peticion);

            while($fila = mysqli_fetch_assoc($resultado)){
                echo "<tr>";
                $contador = 0;
                $id = 0;
                foreach($fila as $columna => $campo){
                    if($columna == "identificador"){
                        $id = $campo;
                    }
                    echo "<td>" .$campo."</td>";
                    if($contador == 0){
                        $id = $campo;
                    }
                $contador++;
                }
                echo "<th>
                        <div class='contenedorcruz'>
                            <a href='?accion=eliminar&id=".$id."&tabla=".$_GET['tabla']."' class='boton eliminar'>X</a>
                        </div>
                        
                    </th>";
                echo"</tr>";
            }

            
        }
    }

    //FUNCION PARA INSERTAR REGISTRO EN CADA TABLA
    function insertarRegistro($conexion){

        $consulta = "INSERT INTO ".$_GET['tabla']." VALUES (NULL,";
        foreach ($_POST as $columna => $campo){
            if ($columna != "identificador"){
                $consulta .= "'".$campo."',";
            }
        }

        $consulta = substr($consulta,0,-1);
        $consulta .= ");";

        mysqli_query($conexion,$consulta);

    }

    //FUNCION QUE MUESTRA FORMULARIO PARA INSERTAR EN FUNCION DE CADA TABLA
    function formularioInsertar($conexion){
        echo "<h4>Nuevo elemento para la tabla: ".$_GET['tabla']."</h4>";
        echo "<form action='?accion=insertar&tabla=".$_GET['tabla']."' method='POST'>";

        $peticion = "SHOW COLUMNS FROM " . $_GET['tabla'] . ";";
        $resultado = mysqli_query($conexion,$peticion);
                                    
        while($fila = mysqli_fetch_assoc($resultado)){
            echo "<input type='text' name='".$fila['Field']."' placeholder='".$fila['Field']."'></input>";
        }    
        echo "<input type='submit'>";
        echo "</form>";
    }

?>
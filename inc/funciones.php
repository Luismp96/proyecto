<?php

    function comprobarAcceso(){

        if(!isset($_SESSION['usuario'])){
            die("<aside><div class='incorrecto'>X</div>Intento Incorrecto</aside>");
        }
    }

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

    function mostrarCabecera($conexion){

        if(isset($_GET['tabla'])){
            $peticion = "SHOW COLUMNS FROM " . $_GET['tabla'] . ";";
            $resultado = mysqli_query($conexion,$peticion);
            
            while($fila = mysqli_fetch_assoc($resultado)){

                //P4 INI -> CABECERA MAYUSCULAS
                switch($fila['Field']){
                    case ("identificador"):
                        echo "<th>IDENTIFICADOR</th>";
                        break;
                    case ("id_usuario"):
                        echo "<th>USUARIO</th>";
                        break;
                    case ("id_respuesta"):
                        echo "<th>IDENTIFICADOR</th>";
                        break;
                    case ("titulo"):
                        echo "<th>TITULO</th>";
                        break;
                    case ("texto"):
                        echo "<th>RESPUESTA</th>";
                        break;
                    case ("palabrasclave"):
                        echo "<th>PALABRAS CLAVE</th>";
                        break;
                    case ("id_categoria"):
                        echo "<th>CATEGORIA</th>";
                        break;
                    case ("fecha"):
                        echo "<th>FECHA</th>";
                        break;
                    case ("id_pregunta"):
                        echo "<th>TEXTO PREGUNTA</th>";
                        break;
                    case ("valor"):
                        echo "<th>VALOR</th>";
                        break;
                    case ("usuario"):
                        echo "<th>USUARIO</th>";
                        break;
                    case ("contrasena"):
                        echo "<th>CONTRASEÑA</th>";
                        break;
                    case ("nombre"):
                        echo "<th>NOMBRE</th>";
                        break;
                    case ("apellidos"):
                        echo "<th>APELLIDOS</th>";
                        break;
                    case ("email"):
                        echo "<th>E-MAIL</th>";
                        break;
                    case ("imagen"):
                        echo "<th>IMAGEN</th>";
                        break;
                    case ("id_admin"):
                        echo "<th>ADMIN</th>";
                        break;
                    case ("id_categoriablog"):
                        echo "<th>CAT. BLOG</th>";
                        break;
                    case ("epoch"):
                        echo "<th>FECHA</th>";
                        break;
                    case ("ip"):
                        echo "<th>IP</th>";
                        break;
                    case ("navegador"):
                        echo "<th>NAVEGADOR</th>";
                        break;
                    case ("sesion"):
                        echo "<th>SESION</th>";
                        break;
                    case ("request"):
                        echo "<th>PETICION</th>";
                        break;
                    default:
                        echo "<th>" .$fila['Field']."</th>";
                        break;
                }
                //P4 FIN
                
            }

            echo "<th>
                        OPERACIONES
                </th>";
            echo"</tr>";
        }
       
    }

    function mostrarNombreTabla(){
        if(isset($_GET['tabla'])){

            echo "<p style='color:black; text-align:center;padding-bottom:10px'><b>TABLA: </b>".$_GET['tabla']."</p>";
            //P4 INI -> SOLO SE MUESTRA AÑADIR SI SELECCIONAMOS UNA TABLA
            echo "<a href='?operacion=nuevo&tabla=".$_GET['tabla']."' class='boton nuevo'>AÑADIR</a>";
            echo "<a href='?accion=borrartodo&tabla=".$_GET['tabla']."' class='boton' id='all'>BORRAR TODO</a>";
            echo "";
        }else{
            echo "<p style='color:black; text-align:center;padding-bottom:10px'><b>SELECCIONE UNA TABLA DE LA BBDD</b></p>";
            //P4 FIN
        }
    }

    function mostrarDatos($conexion){
        if(isset($_GET['tabla'])){

            $peticion = "SELECT * FROM " . $_GET['tabla'] . ";";
            $resultado = mysqli_query($conexion,$peticion);

            while($fila = mysqli_fetch_assoc($resultado)){
                echo "<tr>";
                $contador = 0;
                $id = 0;
                foreach($fila as $columna=>$campo){
                    if($columna == "identificador"){
                        $id = $campo;
                    }
                    //P4 -> DESPLEGABLE EN LA CONSULTA
                    if(strpos($columna,"_") !== false){
                        if ($columna != "identificador"){

                            //ID USUARIO
                            if(explode("_",$columna)[1] == "usuario"){
                                echo "<td>";
                                $peticion2 = "SELECT ".explode("_",$columna)[1]." AS campo FROM usuarios WHERE identificador = ".$campo.";";
                                $resultado2 = mysqli_query($conexion,$peticion2);
                                while($fila2 = mysqli_fetch_assoc($resultado2)){
                                    echo $fila2['campo'];
                                }
                                echo "</td>";
                            }

                            //ID CATEGORIA
                            if(explode("_",$columna)[1] == "categoria"){
                                echo "<td>";
                                $peticion2 = "SELECT nombre AS campo FROM categorias WHERE identificador = ".$campo.";";
                                $resultado2 = mysqli_query($conexion,$peticion2);

                                while($fila2 = mysqli_fetch_assoc($resultado2)){
                                    echo $fila2['campo'];
                                }
                                echo "</td>";
                            }

                            //ID ADMIN
                            if(explode("_",$columna)[1] == "admin"){
                                echo "<td>";
                                $peticion2 = "SELECT usuario AS campo FROM administradores WHERE identificador = ".$campo.";";
                                $resultado2 = mysqli_query($conexion,$peticion2);

                                while($fila2 = mysqli_fetch_assoc($resultado2)){
                                    echo $fila2['campo'];
                                }
                                echo "</td>";
                            }

                            //ID CATEGORIA BLOG
                            if(explode("_",$columna)[1] == "categoriablog"){
                                echo "<td>";
                                $peticion2 = "SELECT nombre AS campo FROM categoriasblog WHERE identificador = ".$campo.";";
                                $resultado2 = mysqli_query($conexion,$peticion2);

                                while($fila2 = mysqli_fetch_assoc($resultado2)){
                                    echo $fila2['campo'];
                                }
                                echo "</td>";
                            }

                            //ID PREGUNTA
                            if(explode("_",$columna)[1] == "pregunta"){
                                echo "<td>";
                                $peticion2 = "SELECT titulo AS campo FROM preguntas WHERE identificador = ".$campo.";";
                                $resultado2 = mysqli_query($conexion,$peticion2);

                                while($fila2 = mysqli_fetch_assoc($resultado2)){
                                    echo $fila2['campo'];
                                }
                                echo "</td>";
                            }

                            //ID PREGUNTA
                            if(explode("_",$columna)[1] == "respuesta"){
                                echo "<td>";
                                $peticion2 = "SELECT texto AS campo FROM respuestas WHERE identificador = ".$campo.";";
                                $resultado2 = mysqli_query($conexion,$peticion2);

                                while($fila2 = mysqli_fetch_assoc($resultado2)){
                                    echo $fila2['campo'];
                                }
                                echo "</td>";
                            }
                            
                        }else{
                            echo "<td>" .$campo."</td>";
                        }
                        
                    //P4 FINAL
                    }else{
                        echo "<td>" .$campo."</td>";
                    }
                    
                    if($contador == 0){
                        $id = $campo;
                    }
                    $contador++;
                }
                echo "<th class='operaciones'>
                        <a href='?accion=eliminar&id=".$id."&tabla=".$_GET['tabla']."' class='boton eliminar'>X</a>
                        <a href='?operacion=actualizar&id=".$id."&tabla=".$_GET['tabla']."' class='boton actualizar'>?</a>
                    </th>";
                echo"</tr>";
            }

            
        }
    }

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

    //P4 INICIO
    function eliminarRegistro($conexion){

        $consulta = "DELETE FROM ".$_GET['tabla']." WHERE identificador = ".$_GET['id'].";";
        mysqli_query($conexion,$consulta);

    }

    function actualizarRegistro($conexion){

        $consulta = "UPDATE ".$_GET['tabla']." SET ";
        foreach ($_POST as $columna => $campo){

            if ($columna != "identificador"){

                if((strpos($columna,"_")) !== false){

                    //ID ADMIN
                    if(explode("_",$columna)[1] == "admin"){

                        $peticion1 = "SELECT * FROM administradores WHERE usuario = '".$campo."';";
                        $resultado1= mysqli_query($conexion,$peticion1);
                        $fila1 = mysqli_fetch_assoc($resultado1);

                        $id = $fila1['identificador'];

                        $consulta .= $columna. " = '".$id."',";
                    }

                    //ID CATEGORIA BLOG
                    if(explode("_",$columna)[1] == "categoriablog"){

                        $peticion1 = "SELECT * FROM categoriasblog WHERE nombre = '".$campo."';";
                        $resultado1= mysqli_query($conexion,$peticion1);
                        $fila1 = mysqli_fetch_assoc($resultado1);

                        $id = $fila1['identificador'];
                        $consulta .= $columna. " = '".$id."',";
                    }

                    //ID USUARIOS
                    if(explode("_",$columna)[1] == "usuario"){

                        $peticion1 = "SELECT * FROM usuarios WHERE usuario = '".$campo."';";
                        $resultado1= mysqli_query($conexion,$peticion1);
                        $fila1 = mysqli_fetch_assoc($resultado1);

                        $id = $fila1['identificador'];
                        $consulta .= $columna. " = '".$id."',";
                    }

                    //ID CATEGORIA 
                    if(explode("_",$columna)[1] == "categoria"){

                        $peticion1 = "SELECT * FROM categorias WHERE nombre = '".$campo."';";
                        $resultado1= mysqli_query($conexion,$peticion1);
                        $fila1 = mysqli_fetch_assoc($resultado1);

                        $id = $fila1['identificador'];
                        $consulta .= $columna. " = '".$id."',";
                    }

                    //ID PREGUNTA
                    if(explode("_",$columna)[1] == "pregunta"){

                        $peticion1 = "SELECT * FROM preguntas WHERE titulo = '".$campo."';";
                        $resultado1= mysqli_query($conexion,$peticion1);
                        $fila1 = mysqli_fetch_assoc($resultado1);

                        $id = $fila1['identificador'];
                        $consulta .= $columna. " = '".$id."',";
                    }

                    //ID RESPUESTA
                    if(explode("_",$columna)[1] == "respuesta"){

                        $peticion1 = "SELECT * FROM respuestas WHERE texto = '".$campo."';";
                        $resultado1= mysqli_query($conexion,$peticion1);
                        $fila1 = mysqli_fetch_assoc($resultado1);

                        $id = $fila1['identificador'];
                        $consulta .= $columna. " = '".$id."',";
                    }


                }else{
                    $consulta .= $columna. " = '".$campo."',";
                }

                
            }
        }

        $consulta = substr($consulta,0,-1);
        $consulta .= " WHERE identificador = ".$_GET['id'].";";
        mysqli_query($conexion,$consulta);

    }

    //P4 -> DESPLEGABLES EN ACTUALIZAR
    function formularioActualizar($conexion){

        echo "<h4>Nuevo elemento para la tabla: ".$_GET['tabla']."</h4>";
        echo "<form action='?accion=actualizar&tabla=".$_GET['tabla']."&id=".$_GET['id']."' method='POST'>";

        $consulta = "SELECT * FROM ".$_GET['tabla']." WHERE identificador = ".$_GET['id'].";";
        $resultado = mysqli_query($conexion,$consulta);

        while($fila = mysqli_fetch_assoc($resultado)){

            foreach($fila as $columna=>$campo){

                if((strpos($columna,"_")) !== false){

                    //ID USUARIO
                    if(explode("_",$columna)[1] == "usuario"){

                        $peticion1 = "SELECT * FROM usuarios WHERE identificador = ".$campo.";";
                        $resultado1= mysqli_query($conexion,$peticion1);
                        $fila1 = mysqli_fetch_assoc($resultado1);

                        echo "<select name='".$columna."' value='".$fila1['usuario']."'>
                        <option>".$fila1['usuario']."</option>
                        ";

                        $peticion2 = "SELECT * FROM usuarios;";
                        $resultado2 = mysqli_query($conexion,$peticion2);

                        while($fila2 = mysqli_fetch_assoc($resultado2)){
                            echo "<option value='".$fila2['usuario']."'>".$fila2['usuario']."</option>";
                        }

                        echo "</select>";
                    }

                    //ID CATEGORIA
                    if(explode("_",$columna)[1] == "categoria"){

                        $peticion1 = "SELECT * FROM categorias WHERE identificador = ".$campo.";";
                        $resultado1= mysqli_query($conexion,$peticion1);
                        $fila1 = mysqli_fetch_assoc($resultado1);

                        echo "<select name='".$columna."'value='".$fila1['nombre']."'>
                        <option>".$fila1['nombre']."</option>
                        ";

                        $peticion2 = "SELECT * FROM categorias;";
                        $resultado2 = mysqli_query($conexion,$peticion2);

                        while($fila2 = mysqli_fetch_assoc($resultado2)){
                            echo "<option value='".$fila2['nombre']."'>".$fila2['nombre']."</option>";
                        }

                        echo "</select>";
                    }

                    //ID ADMIN
                    if(explode("_",$columna)[1] == "admin"){

                        $peticion1 = "SELECT * FROM administradores WHERE identificador = ".$campo.";";
                        $resultado1= mysqli_query($conexion,$peticion1);
                        $fila1 = mysqli_fetch_assoc($resultado1);

                        echo "<select name='".$columna."' value='".$fila1['usuario']."'>
                        <option>".$fila1['usuario']."</option>
                        ";

                        $peticion2 = "SELECT * FROM administradores;";
                        $resultado2 = mysqli_query($conexion,$peticion2);

                        while($fila2 = mysqli_fetch_assoc($resultado2)){
                            echo "<option value='".$fila2['usuario']."'>".$fila2['usuario']."</option>";
                        }

                        echo "</select>";
                    }

                    //ID CATEGORIA BLOG
                    if(explode("_",$columna)[1] == "categoriablog"){

                        $peticion1 = "SELECT * FROM categoriasblog WHERE identificador = ".$campo.";";
                        $resultado1= mysqli_query($conexion,$peticion1);
                        $fila1 = mysqli_fetch_assoc($resultado1);

                        echo "<select name='".$columna."' value='".$fila1['nombre']."'>
                        <option>".$fila1['nombre']."</option>
                        ";

                        $peticion2 = "SELECT * FROM categoriasblog;";
                        $resultado2 = mysqli_query($conexion,$peticion2);

                        while($fila2 = mysqli_fetch_assoc($resultado2)){
                            echo "<option value='".$fila2['nombre']."'>".$fila2['nombre']."</option>";
                        }

                        echo "</select>";
                    }

                    //ID PREGUNTA
                    if(explode("_",$columna)[1] == "pregunta"){

                        $peticion1 = "SELECT * FROM preguntas WHERE identificador = ".$campo.";";
                        $resultado1= mysqli_query($conexion,$peticion1);
                        $fila1 = mysqli_fetch_assoc($resultado1);

                        echo "<select name='".$columna."' value='".$fila1['titulo']."'>
                        <option>".$fila1['titulo']."</option>
                        ";

                        $peticion2 = "SELECT * FROM preguntas;";
                        $resultado2 = mysqli_query($conexion,$peticion2);

                        while($fila2 = mysqli_fetch_assoc($resultado2)){
                            echo "<option value='".$fila2['titulo']."'>".$fila2['titulo']."</option>";
                        }

                        echo "</select>";
                    }

                    //ID RESPUESTA
                    if(explode("_",$columna)[1] == "respuesta"){

                        $peticion1 = "SELECT * FROM respuestas WHERE identificador = ".$campo.";";
                        $resultado1= mysqli_query($conexion,$peticion1);
                        $fila1 = mysqli_fetch_assoc($resultado1);

                        echo "<select name='".$columna."' value='".$fila1['texto']."'>
                        <option>".$fila1['texto']."</option>
                        ";

                        $peticion2 = "SELECT * FROM respuestas;";
                        $resultado2 = mysqli_query($conexion,$peticion2);

                        while($fila2 = mysqli_fetch_assoc($resultado2)){
                        echo "<option value='".$fila2['texto']."'>".$fila2['texto']."</option>";
                        }

                        echo "</select>";
                    }
                    
                
                }else{
                    echo "<input type='text' name='".$columna."' value='".$campo."'></input>";
                }
            }
        }

        echo "<input type='submit'>";
        echo "</form>";

    }
    //P4 FINAL

    function formularioInsertar($conexion){
        echo "<h4>Nuevo elemento para la tabla: ".$_GET['tabla']."</h4>";
        echo "<form action='?accion=insertar&tabla=".$_GET['tabla']."' method='POST'>";

        $peticion = "SHOW COLUMNS FROM " . $_GET['tabla'] . ";";
        $resultado = mysqli_query($conexion,$peticion);

        while($fila = mysqli_fetch_assoc($resultado)){

            //P4 INICIO -> CAMPOS CLAVE FORANEA (DESPLEGABLES)
            if(strpos($fila['Field'],"_") !== false){
                

                //ID USUARIO
                if(explode("_",$fila['Field'])[1] == "usuario"){
                    echo "<select name='".$fila['Field']."'>
                    <option>Selecciona un USUARIO</option>
                    ";

                    $peticion2 = "SELECT * FROM usuarios;";
                    $resultado2 = mysqli_query($conexion,$peticion2);

                    while($fila2 = mysqli_fetch_assoc($resultado2)){
                        echo "<option value='".$fila2['identificador']."'>".$fila2['usuario']."</option>";
                    }

                    echo "</select>";
                }

                //ID CATEGORIA
                if(explode("_",$fila['Field'])[1] == "categoria"){
                    echo "<select name='".$fila['Field']."'>
                    <option>Selecciona una CATEGORIA DE LA PREGUNTA</option>
                    ";

                    $peticion2 = "SELECT * FROM categorias;";
                    $resultado2 = mysqli_query($conexion,$peticion2);

                    while($fila2 = mysqli_fetch_assoc($resultado2)){
                        echo "<option value='".$fila2['identificador']."'>".$fila2['nombre']."</option>";
                    }

                    echo "</select>";
                }

                //ID ADMIN
                if(explode("_",$fila['Field'])[1] == "admin"){
                    echo "<select name='".$fila['Field']."'>
                    <option>Selecciona un ADMINISTRADOR</option>
                    ";

                    $peticion2 = "SELECT * FROM administradores;";
                    $resultado2 = mysqli_query($conexion,$peticion2);

                    while($fila2 = mysqli_fetch_assoc($resultado2)){
                        echo "<option value='".$fila2['identificador']."'>".$fila2['usuario']."</option>";
                    }

                    echo "</select>";
                }

                //ID CATEGORIA BLOG
                if(explode("_",$fila['Field'])[1] == "categoriablog"){
                    echo "<select name='".$fila['Field']."'>
                    <option>Selecciona una CATEGORIAS DE LA ENTRADA</option>
                    ";

                    $peticion2 = "SELECT * FROM categoriasblog;";
                    $resultado2 = mysqli_query($conexion,$peticion2);

                    while($fila2 = mysqli_fetch_assoc($resultado2)){
                        echo "<option value='".$fila2['identificador']."'>".$fila2['nombre']."</option>";
                    }

                    echo "</select>";
                }

                //ID PREGUNTA
                if(explode("_",$fila['Field'])[1] == "pregunta"){
                    echo "<select name='".$fila['Field']."'>
                    <option>Selecciona una PREGUNTA</option>
                    ";

                    $peticion2 = "SELECT * FROM preguntas;";
                    $resultado2 = mysqli_query($conexion,$peticion2);

                    while($fila2 = mysqli_fetch_assoc($resultado2)){
                        echo "<option value='".$fila2['identificador']."'>".$fila2['titulo']."</option>";
                    }

                    echo "</select>";
                }

                //ID RESPUESTA
                if(explode("_",$fila['Field'])[1] == "respuesta"){
                    echo "<select name='".$fila['Field']."'>
                    <option>Selecciona una RESPUESTAS</option>
                    ";

                    $peticion2 = "SELECT * FROM respuestas;";
                    $resultado2 = mysqli_query($conexion,$peticion2);

                    while($fila2 = mysqli_fetch_assoc($resultado2)){
                        echo "<option value='".$fila2['identificador']."'>".$fila2['texto']."</option>";
                    }

                    echo "</select>";
                }

            }else{

                echo "<input type='text' name='".$fila['Field']."' placeholder='".$fila['Field']."'></input>";
            }
            //P4 FINAL
        }    
        echo "<input type='submit'>";
        echo "</form>";
    }

    //P4 INICIO -> FUNCION BORRAR TODO
    function borrartodo($conexion){

        $peticion = "DELETE FROM " . $_GET['tabla'] . ";";
        $resultado = mysqli_query($conexion,$peticion);

    }
    //P4 FIN

?>
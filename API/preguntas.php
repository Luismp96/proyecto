<?php

    include "../config.php";

    $peticion = "SELECT * FROM preguntas ORDER BY fecha DESC;";
    $resultado = mysqli_query($conexion,$peticion);
    $datos = [];
        
    while($fila = mysqli_fetch_assoc($resultado)){
        $datos[] = $fila;

    }

    $json = json_encode($datos);
    echo $json;
    
?>
<?php

    include "../config.php";

    $peticion = "INSERT INTO preguntas 
                 VALUES (NULL,
                 2,
                 '".$_GET['titulo']."',
                 '".$_GET['textopregunta']."',
                 '".$_GET['palabrasclave']."',
                 1,
                '".date("Y-m-d")."'
    );";
    mysqli_query($conexion,$peticion);
    
?>
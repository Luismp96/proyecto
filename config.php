<?php

    $usuario = "proyecto";
    $contrasena = "proyecto";
    $basededatos = "proyecto";
    $servidor = "localhost";

    //CONEXION BBDD (sin creacion de objeto MSQLI)
    $conexion = mysqli_connect($servidor,$usuario,$contrasena,$basededatos);    

?>
<?php

    include "log.php";
?>

<!DOCTYPE html>

<html lang="es">

    <head>
        <title>Panel de Control</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./css/estilos.css">
    </head>
    <body>
        <form action="login.php" method="POST">
            <img src="./img/logo.png">
            <input type="text" name="usuario" placeholder="Usuario: ">
            <input type="password" name="contrasena" placeholder="Contraseña: ">
            <input type="submit">
        </form>
    </body>


</html>
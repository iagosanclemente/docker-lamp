<?php

//1. Crear la conexión y comprobar la conexión
function obtenerConexion() {

    $conexion = new mysqli('db', 'root', 'test');

    $error = $conexion->connect_errno;
    if($error !=null){
        die('Fallo en la conexión: ' . $conexion->connect_error . ', con numero ' . $error . '.<br>');
    }
    
    return $conexion;
}

//1.1 Crear la conexión con TAREAS y comprobar la conexión
function obtenerConexionTareas() {

    $conexion = new mysqli('db', 'root', 'test', 'tareas');

    $error = $conexion->connect_errno;
    if($error !=null){
        die('Fallo en la conexión: ' . $conexion->connect_error . ', con numero ' . $error . '.<br>');
    }
    
    return $conexion;
}

//2. Cerrar la conexión
function cerrarConexion($conexion) {
    if ($conexion && !$conexion->connect_errno) {
        $conexion->close();
        echo 'Conexión cerrada correctamente.<br>';
    } else {
        echo 'No se pudo cerrar la conexión o la conexión ya estaba cerrada.<br>';
    }
}



?>

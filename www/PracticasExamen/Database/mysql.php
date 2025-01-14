<?php

include "dbconect.php";


function createUsuario($u) {

    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellido, email) 
    VALUES (?,?,?)");
    $stmt->bind_param("sss", $nombre, $apellido, $email);

    //6.2. Establecer parámetros y ejecutar
    $nombre = "alejandro";
    $apellido = "Garcia";
    $email = "alejandro@edu.com";
    $stmt->execute(); 

    $nombre = "Julian";
    $apellido = "Garcia";
    $email = "julian@edu.com";
    $stmt->execute(); 

    echo 'Nuevos registros creados correctamente<br>';

    $stmt->close();

}

function selectUsuarios ($id = null) {

    $conexion = conexionDB();

    $sql = "SELECT id, nombre, apellido FROM clientes";

    if (isset($id)) {
        $sql .= " WHERE id = " . $id;
    }
        //Se ejecuta la consulta y almacena el resultado.
        $resultados = $conexion->query($sql);

        $conexion->close();

        //Con num_rows se verifica si se devuelven más de cero filas
        if($resultados->num_rows > 0){
            //fetch_assoc() coloca todos los resultados en una matriz asociativa que podemos recorrer
            //Con el bucle se recorre el conjunto de resultados y recuperan los datos de las columnas id, nombre y apellido para cada registro
            while ($row = $resultados->fetch_assoc()) {
                echo $row["id"] . " - " . $row["nombre"] . ' ' . $row["apellido"] . '<br>';
            }
        }
        else {
            echo "No hay resultados";
        }

}

function deleteUsuario ($id) {

    $conexion = conexionDB();

    // sql para borrar un cliente
    $sql = "DELETE FROM usuarios WHERE id=3";
    if ($conexion->query($sql)) {
        echo "Eliminado correctamente<br>";
    }
    else {
        echo "Error eliminando : " . $conexion->error;
    }

    $conexion-> close();

}

function updateUsuario () {

    $conexion = conexionDB();

    //sql para actualizar un cliente
    $sql = "UPDATE clientes SET apellido='Sanz' WHERE nombre='Marco'";
    if ($conexion->query($sql)) {
        echo "Actualizado correctamente<br>";
    }
    else {
        echo "Error actualizando : " . $conexion->error;
    }

    $conexion->close();

}

function updateUsuarioPrepared () {


    function updateUsuario($nombre, $nuevoApellido) {
        // Crear la conexión a la base de datos
        $conexion = conexionDB();
    
        // Preparar la consulta SQL con parámetros
        $sql = "UPDATE clientes SET apellido = ? WHERE nombre = ?";
        $stmt = $conexion->prepare($sql);
    
        if ($stmt) {
            // Vincular los parámetros a la consulta
            $stmt->bind_param("ss", $nuevoApellido, $nombre);
    
            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Actualizado correctamente<br>";
            } else {
                echo "Error actualizando: " . $stmt->error;
            }
    
            // Cerrar el statement
            $stmt->close();
        } else {
            echo "Error preparando la consulta: " . $conexion->error;
        }
    
        // Cerrar la conexión
        $conexion->close();
    }
    


}

?>
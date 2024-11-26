<?php

include 'mysqli.php'; // Incluir las funciones de conexión

// CREAR LA BASE DE DATOS SI NO EXISTE (tareas)

//3. Crear la base de datos
function  creaDB ($conexion) {

    // Comprobar si la base de datos ya existe
    $sql_check = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'tareas'";
    $result = $conexion->query($sql_check);

    if ($result->num_rows > 0) {
        return ['status' => 'info', 'message' => 'BASE DE DATOS "tareas" ya existe.'];
    }

    // Intentar crear la base de datos
    $sql = 'CREATE DATABASE IF NOT EXISTS tareas';
    if ($conexion->query($sql)) {
        return ['status' => 'success', 'message' => 'BASE DE DATOS "tareas" creada correctamente.'];
    } else {
        return ['status' => 'error', 'message' => 'Error creando la BASE DE DATOS "tareas": ' . $conexion->error];
    }
}

//4. Crear las tablas
function crearTablaUsuarios($conexion) {
    try {

         // Verificar si la tabla ya existe
         $sql_check = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'tareas' AND TABLE_NAME = 'usuarios'";
         $result = $conexion->query($sql_check);
 
         if ($result->num_rows > 0) {
             return ['status' => 'info', 'message' => 'La tabla "usuarios" ya existe.'];
         }


        $sql_tabla1 = 'CREATE TABLE `usuarios` (
                    `id` int NOT NULL AUTO_INCREMENT COMMENT "Clave primaria. Autoincremental.",
                    `username` varchar(50) NOT NULL,
                    `nombre` varchar(50) NOT NULL,
                    `apellidos` varchar(100) NOT NULL,
                    `contrasena` varchar(100) NOT NULL,
                    PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci';

        $conexion->select_db('tareas');
        if ($conexion->query($sql_tabla1)) {
            return ['status' => 'success', 'message' => 'Tabla "usuarios" creada correctamente.'];
        } else {
            return ['status' => 'error', 'message' => 'Error creando la tabla "usuarios": ' . $conexion->error];
        }
    } catch (Exception $e) {
        return ['status' => 'error', 'message' => 'Se produjo un error: ' . $e->getMessage()];
    }
}

function crearTablaTareas($conexion) {
    try {

        // Verificar si la tabla ya existe
        $sql_check = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'tareas' AND TABLE_NAME = 'tareas'";
        $result = $conexion->query($sql_check);

        if ($result->num_rows > 0) {
            return ['status' => 'info', 'message' => 'La tabla "tareas" ya existe.'];
        }

        $sql_tabla2 = 'CREATE TABLE IF NOT EXISTS `tareas` (
            `id` int NOT NULL AUTO_INCREMENT COMMENT "Clave primaria. Autoincremental.",
            `titulo` varchar(50) NOT NULL,
            `descripcion` varchar(250) NOT NULL,
            `estado` varchar(50) NOT NULL,
            `id_usuario` int NOT NULL,
            PRIMARY KEY (`id`),
            KEY `id_usuario` (`id_usuario`),
            CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci';

        $conexion->select_db('tareas');
        if ($conexion->query($sql_tabla2)) {
            return ['status' => 'success', 'message' => 'Tabla "tareas" creada correctamente.'];
        } else {
            return ['status' => 'error', 'message' => 'Error creando la tabla "tareas": ' . $conexion->error];
        }
    } catch (Exception $e) {
        return ['status' => 'error', 'message' => 'Se produjo un error: ' . $e->getMessage()];
    }
}

function inicializarBaseDeDatos() { // ARREGLAR PARA MANEJAR LAS 2 CONEXIONES
    // Array para almacenar los resultados de cada operación
    $resultados = [];

    $conexion = obtenerConexion();
    $conexionTarea = obtenerConexionTarea();

    // Crear la base de datos
    $resultados[] = creaDB($conexion); // Aquí debería devolver un array con el resultado (success, error, etc.)
    cerrarConexion($conexion); // Cerrar la conexión después de las operaciones

    if (is_array($conexion) && $conexion['status'] === 'error') {
        $resultados[] = $conexion; // Si hay error de conexión, se agrega el error al array
    } else {
        $resultados[] = crearTablaUsuarios($conexionTarea);
        $resultados[] = crearTablaTareas($conexionTarea);
        cerrarConexion($conexionTarea); // Cerrar la conexión después de las operaciones
    }

    return $resultados;
}

?>

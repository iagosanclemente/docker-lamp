<?php

include_once "dbconect.php";

function createDB() {
    try {
        // Crear la conexión sin especificar base de datos
        $conexion = new mysqli('db', 'root', 'test');
        echo 'Conexión correcta<br>';

        // Comprobar si la base de datos ya existe
        $sql = "SHOW DATABASES LIKE 'pruebaExamen'";
        $result = $conexion->query($sql);
        if ($result->num_rows > 0) {
            return ['estado' => 'info', 'mensaje' => 'La base de datos ya existe.'];
        } else {
            // Crear la base de datos
            $sql = 'CREATE DATABASE pruebaExamen';
            if ($conexion->query($sql)) {
                return ['estado' => 'success', 'mensaje' => 'Base de datos creada correctamente.'];
            } else {
                return ['estado' => 'error', 'mensaje' => 'Error al crear la base de datos: ' . $conexion->error];
            }
        }
    } catch (mysqli_sql_exception $e) {
        return ['estado' => 'error', 'mensaje' => 'Error en la conexión: ' . $e->getMessage()];
    } finally {
        // Cerrar la conexión si se estableció correctamente
        if (isset($conexion) && $conexion->connect_errno === 0) {
            $conexion->close();
            echo 'Conexión cerrada.<br>';
        }
    }
}

function createTables() {
    try {
        // Conectar a la base de datos existente
        $conexion = new mysqli('db', 'root', 'test', 'pruebaExamen');

        // Comprobar si la tabla ya existe
        $sql = "SHOW TABLES LIKE 'usuarios'";
        $result = $conexion->query($sql);
        if ($result->num_rows > 0) {
            return ['estado' => 'info', 'mensaje' => 'La tabla ya existe.'];
        } else {
            // Crear la tabla
            $sql = 'CREATE TABLE usuarios (
                id INT(6) AUTO_INCREMENT PRIMARY KEY, 
                nombre VARCHAR(30) NOT NULL, 
                apellido VARCHAR(30) NOT NULL,
                email VARCHAR(50) NOT NULL UNIQUE
            )';

            if ($conexion->query($sql)) {
                return ['estado' => 'success', 'mensaje' => 'Tabla creada correctamente.'];
            } else {
                return ['estado' => 'error', 'mensaje' => 'Error al crear la tabla: ' . $conexion->error];
            }
        }
    } catch (mysqli_sql_exception $e) {
        return ['estado' => 'error', 'mensaje' => 'Error en la conexión: ' . $e->getMessage()];
    } finally {
        // Cerrar la conexión si se estableció correctamente
        if (isset($conexion) && $conexion->connect_errno === 0) {
            $conexion->close();
            echo 'Conexión cerrada.<br>';
        }
    }
}

function inicializarDB() {
    $resultados = [];

    // Crear la base de datos
    $resDB = createDB();
    array_push($resultados, $resDB);

    // Crear la tabla
    $resTabla = createTables();
    array_push($resultados, $resTabla);

    // Retornar el resultado general
    return $resultados;
}


?>
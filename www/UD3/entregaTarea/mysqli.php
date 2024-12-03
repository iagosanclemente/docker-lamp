<?php

include_once "utils.php";

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
        // echo 'Conexión cerrada correctamente.<br>';
    } else {
        echo 'No se pudo cerrar la conexión o la conexión ya estaba cerrada.<br>';
    }
}

//3. SELECT
function selectTareas($id = null) {

    $conexion = obtenerConexionTareas();

    $sql = "SELECT tareas.*, usuarios.username FROM tareas INNER JOIN usuarios ON tareas.id_usuario = usuarios.id";

    if($id !== null) {
        $sql .= " WHERE tareas.id = $id"; 
    }

    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $tareas = $resultado->fetch_all(MYSQLI_ASSOC);
        cerrarConexion($conexion);
        return $tareas;
    } else {
        cerrarConexion($conexion);
        return []; 
    }

}

//4. CREATE

function createTarea($tarea) {

    try {
        $conexion = obtenerConexionTareas();

        $stmt = $conexion->prepare("INSERT INTO tareas (titulo, descripcion, estado, id_usuario)
        values(?,?,?,?)");
        $stmt->bind_param("ssss", $titulo, $descripcion, $estado, $id_usuario);

        $titulo = $tarea['titulo'];
        $descripcion = $tarea['descripcion'];
        $estado = $tarea['estado'];
        $id_usuario = $tarea['id_usuario'];

        $executeResult= $stmt->execute();

        if ($executeResult) {
            return ['status' => 'success', 'message' => 'Tarea actualizada correctamente.'];
        } else {
            throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
        }

    } catch (Exception $e) {
        return ['status' => 'error', 'message' => 'Error al crear tarea : ' . $e->getMessage()];
    } finally {
        $stmt->close();
        cerrarConexion($conexion);
    }

}

//5. DELETE

function deleteTarea($id_tarea , $id_usuario) {

    $conexion = obtenerConexionTareas();

    try {

        $sql = "DELETE FROM tareas WHERE id =" . $id_tarea . " AND id_usuario =" .$id_usuario;
        $conexion->query($sql);

        return ['status' => 'success' , 'message' => 'Tarea eliminada correctamente.'];
    } catch (Exception $e){
        return ['status' => 'error' , 'message' => 'Error al eliminar tarea : ' . $e->getMessage()];
    } finally {
        cerrarConexion($conexion);
    }

}

//6. UPDATE

function updateTarea($tarea) {

    $conexion = obtenerConexionTareas();

    try {

        $stmt = $conexion->prepare("UPDATE tareas SET titulo = ?, descripcion = ? , estado = ? WHERE id = ? AND id_usuario = ?");
        $stmt->bind_param("sssii", $tarea['titulo'], $tarea['descripcion'], $tarea['estado'], $tarea['id'], $tarea['id_usuario']);

        $executeResult = $stmt->execute();
        
        if ($executeResult) {
            return ['status' => 'success', 'message' => 'Tarea actualizada correctamente.'];
        } else {
            throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
        }
    }catch (Exception $e){
        return ['status' => 'error' , 'message' => 'Error al actualizar tarea : ' . $e->getMessage()];
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        cerrarConexion($conexion);
    }

}

?>

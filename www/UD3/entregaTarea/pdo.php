<?php

include_once "utils.php";


//1. Crear la conexión y comprobar la conexión PDO
function obtenerConexionPDO() {

    $servername = 'db';
    $username = 'root';
    $password = 'test';
    $dbname = 'tareas';

    try {
        $conPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        //  Forzar excepciones
        $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo 'Conexión correcta';
    } catch(PDOException $e) {
        echo 'Fallo en conexión: ' . $e->getMessage();
    }
    //3. Cierre de conexión
    return $conPDO;
}

//2. Cerrar la conexión PDO
function cerrarConexionPDO($conPDO) {
    if ($conPDO instanceof PDO) {
        $conPDO=null;
        // echo 'Conexión cerrada correctamente.<br>';
    } else {
        echo 'No se pudo cerrar la conexión o la conexión ya estaba cerrada.<br>';
    }
}

//3. Select USUARIOS

function selectAllUsuarios($id = null) { // El ID tiene que ser opcional

    $conPDO = obtenerConexionPDO(); // abrimos conexion

    $sql = "SELECT * FROM usuarios";

    if ($id !== null) { 
        $sql .= " WHERE id = $id"; 
    }

    //Preparar el select 
    $stmt = $conPDO->prepare($sql);
    $stmt->execute();

    //Recuperamos el resultado y guardamos como array asociativo
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $resultados = $stmt->fetchAll();

    cerrarConexionPDO($conPDO);

    return $resultados; // Resultados va a ser un array
}

// RECUPERAR PRIMERO LOS CAMPOS DEL FORMULARIO
function createNewUsuario ($usuario) {

    $conPDO = obtenerConexionPDO();

    try {
        $sql = "INSERT INTO usuarios (nombre, apellidos, username, contrasena) 
                VALUES (:nombre, :apellidos, :username, :contrasena)";
        $stmt = $conPDO->prepare($sql);

        // Bind de los parámetros desde el array $usuario
        $stmt->bindParam(':nombre', $usuario['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $usuario['apellidos'], PDO::PARAM_STR);
        $stmt->bindParam(':username', $usuario['username'], PDO::PARAM_STR);
        $stmt->bindParam(':contrasena', $usuario['contrasena'], PDO::PARAM_STR);

        $stmt->execute();
        return ['status' => 'success', 'message' => 'Usuario agregado correctamente.'];
    } catch (PDOException $e) {
        return ['status' => 'error', 'message' => 'Error al insertar usuario: ' . $e->getMessage()];
    } finally {
        cerrarConexionPDO($conPDO);
    }
}

// UPDATE
function updateUsuario($usuario) {
    try {
      
        $pdo = obtenerConexionPDO(); 
      
        $sql = "UPDATE usuarios 
                SET nombre = :nombre, apellidos = :apellidos, username = :username, contrasena = :contrasena
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':id', $usuario['id'], PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $usuario['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $usuario['apellidos'], PDO::PARAM_STR);
        $stmt->bindParam(':username', $usuario['username'], PDO::PARAM_STR);
        $stmt->bindParam(':contrasena', $usuario['contrasena'], PDO::PARAM_STR);

        // Ejecutar consulta
        $stmt->execute();
  
        return ['status' => 'success', 'message' => 'Usuario actualizado correctamente.'];
    } catch (PDOException $e) {
        return ['status' => 'error', 'message' => 'Error al actualizar usuario: ' . $e->getMessage()];
    } finally {
        cerrarConexionPDO($pdo); 
    }
}


// BORRAR USUARIOS + TAREAS 

function deleteUsuario ($id) {

    $conPDO = obtenerConexionPDO();

    try {

        // Iniciar una transacción para asegurar consistencia
        $conPDO->beginTransaction();

        // Comprobar si el usuario existe
        $sqlCheckUser = "SELECT COUNT(*) FROM usuarios WHERE id = :id";
        $stmtCheckUser = $conPDO->prepare($sqlCheckUser);
        $stmtCheckUser->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtCheckUser->execute();

        if ($stmtCheckUser->fetchColumn() === 0) {
            throw new Exception("El usuario con ID $id no existe.");
        }

        // Eliminar las tareas del usuario
        $sqlDeleteTasks = "DELETE FROM tareas WHERE id_usuario = :id";
        $stmtDeleteTasks = $conPDO->prepare($sqlDeleteTasks);
        $stmtDeleteTasks->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtDeleteTasks->execute();

        // Eliminar el usuario
        $sqlDeleteUser = "DELETE FROM usuarios WHERE id = :id";
        $stmtDeleteUser = $conPDO->prepare($sqlDeleteUser);
        $stmtDeleteUser->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtDeleteUser->execute();

        // Confirmar los cambios
        $conPDO->commit();

        return ['status' => 'success', 'message' => 'Usuario eliminado correctamente.'];
    } catch (PDOException $e) {
        return ['status' => 'error', 'message' => 'Error al eliminar usuario: ' . $e->getMessage()];
    } finally {
        cerrarConexionPDO($conPDO);
    }
}

// SELECT TAREAS 

function selectTareasUserEstado ($id_usuario = null, $estado_tarea = null) {

    $conPDO = obtenerConexionPDO();


    $sql = "SELECT tareas.*, usuarios.username FROM tareas INNER JOIN usuarios ON tareas.id_usuario = usuarios.id WHERE usuarios.id = $id_usuario";

    if ($estado_tarea !== null) { 
        $sql .= " AND tareas.estado = '$estado_tarea'"; 
    }

    //Preparar el select 
    $stmt = $conPDO->prepare($sql);
    $stmt->execute();

    //Recuperamos el resultado y guardamos como array asociativo
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $resultados = $stmt->fetchAll();

    return $resultados; // Resultados va a ser un array

    cerrarConexionPDO($con);
}

?>


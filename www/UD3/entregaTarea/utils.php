<?php

//Variable global
$listaTareas = [
    array(
        "id" => "Tarea 1" ,
        "desc" => "Realiza una aplicación con PHP." ,
        "estado" => "Pendiente"
    )
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $nombreTarea = $_POST['nombre_tarea'];
    $descripcionTarea = $_POST['descripcion_tarea'];
    $estadoTarea = $_POST['estado_tarea'];

    // Validaciones
    $errores = [];
    
    $nombreTareaFiltrado = filtrarContenido($nombreTarea);
    $descripcionTareaFiltrado = filtrarContenido($descripcionTarea);
    $estadoTareaFiltrado = filtrarContenido($estadoTarea);

    // Validar nombre de la tarea
    $resultadoNombre = esValido($nombreTarea);
    if ($resultadoNombre !== true) {
        $errores[] = $resultadoNombre; // Agregar error si hay problema
    }

    // Validar descripción de la tarea
    $resultadoDescripcion = esValido($descripcionTarea);
    if ($resultadoDescripcion !== true) {
        $errores[] = $resultadoDescripcion;
    }

    // Validar estado de la tarea
    $resultadoEstado = esValido($estadoTarea);
    if ($resultadoEstado !== true) {
        $errores[] = $resultadoEstado;
    }

    // Comprobar si hubo errores
    if (count($errores) > 0) {
        // Mostrar errores
        foreach ($errores as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {
        
        guardarTarea($nombreTarea,$descripcionTarea,$estadoTarea);

    }
}

function devolverLista () {
    global $listaTareas;
    return $listaTareas;
}

function filtrarContenido($campo) {

    // Elimina caracteres especiales y espacios en blanco duplicados
    $campoFiltrado = trim($campo); // Elimina espacios al inicio y al final
    $campoFiltrado = preg_replace('/\s+/', ' ', $campoFiltrado); // Reemplaza múltiples espacios por uno solo
    $campoFiltrado = htmlspecialchars($campoFiltrado, ENT_QUOTES, 'UTF-8'); // Convierte caracteres especiales en entidades HTML

    return $campoFiltrado;
}

function esValido($campo) {

    // Verificar si el campo es un string
    if (!is_string($campo)) {
        return false; // No es una cadena de texto
    }

    // Primero filtramos el campo
    $campoFiltrado = filtrarContenido($campo);

    // Requisitos de validación
    if (empty($campoFiltrado)) {
        return false; // El campo está vacío después de filtrarse
    }
    if (strlen($campoFiltrado) < 3) {
        return false; // Campo demasiado corto 
    }
    if (strlen($campoFiltrado) > 255) {
        return false; // Campo demasiado largo 
    }

    // Si pasa todos los chequeos, devolvemos true
    return true;

}

function guardarTarea ($id,$desc,$estado) {

    global $listaTareas;

    $nuevaTarea = array(
        "id" => $id ,
        "desc" => $desc ,
        "estado" => $estado

    );

    array_push($listaTareas,$nuevaTarea);

    echo "La tarea ha sido guardada de forma satisfactoria. <br>";
    print_r($listaTareas);  // Lo dejo para comprobar por pantalla que está funcionando correctamente

    return true;
}

?>
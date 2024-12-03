<?php

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

?>
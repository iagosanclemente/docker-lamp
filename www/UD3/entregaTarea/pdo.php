<?php

//1. Crear la conexión y comprobar la conexión PDO
function obtenerConexionPDO() {

    $servername = 'db';
    $username = 'root';
    $password = 'test';
    $dbname = 'colegio';

    try {
    $conPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //  Forzar excepciones
    $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Conexión correcta';
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
        echo 'Conexión cerrada correctamente.<br>';
    } else {
        echo 'No se pudo cerrar la conexión o la conexión ya estaba cerrada.<br>';
    }
}

//3. Select USUARIOS

function selectAllUsuarios() {

    $conPDO = obtenerConexionPDO(); // abrimos conexion

    //Preparar el select 
    $stmt = $conPDO->prepare("SELECT * FROM usuarios");
    $stmt->execute();

    //Recuperamos el resultado y guardamos como array asociativo
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $resultados = $stmt->fetchAll();

    cerrarConexionPDO($conPDO);

    return $resultados;
}



?>
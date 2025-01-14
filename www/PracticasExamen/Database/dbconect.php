<?phP

function conexionDB () {


    //1. Crear la conexión 
    $conexion = new mysqli('db', 'root', 'test', 'pruebaExamen');
    //2. Comprobar la conexión
    $error = $conexion->connect_errno;
    if($error !=null){
        die('Fallo en la conexión: ' . $conexion->connect_error . ', con numero ' . $error . '.<br>');
    }
    echo 'Conexión correcta <br>';

    return $conexion;

}

function cerrarConexion ($con) {

    if($con->close()) {
        echo "Conexion cerrada correctamente";
    }else {
        echo "Error al cerrar conexión";
    }

}


?>
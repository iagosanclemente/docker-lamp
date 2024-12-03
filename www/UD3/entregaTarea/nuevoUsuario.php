<?php

include 'pdo.php'; // Incluir las funciones de PDO

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD3. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!--header-->
    <?php
        include "header.php";
    ?>
    <div class="container-fluid">
        <div class="row">
            <!--menu-->
            <?php
                include "menu.php";
             ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Nuevo Usuario</h2>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
                        
                        // Crear el array $usuario con los datos del formulario, ya filtrados
                        $usuario = [
                            'nombre'    => filtrarContenido($_POST['nombre_usuario']),
                            'apellidos'  => filtrarContenido($_POST['apellidos_usuario']),
                            'username'  => filtrarContenido($_POST['username_usuario']),
                            'contrasena'  => filtrarContenido($_POST['contrasena_usuario']),
                        ];

                        // Validaciones
                        $errores = [];

                        foreach ($usuario as $campo => $valor) {
                            if (!esValido($valor)) {
                                $errores[] = "El campo $campo no es válido.";
                            }
                        }

                        // Comprobar si hay errores
                        if (count($errores) > 0) {
                            // Mostrar errores
                            foreach ($errores as $error) {
                                echo "<p style='color:red;'>$error</p>";
                            }
                        } else {

                            $resultado = createNewUsuario($usuario);
                            if ($resultado['status'] == 'success') {
                                echo "<div class='alert alert-success' role='alert'>{$resultado['message']}</div>";
                            } elseif ($resultado['status'] == 'error') {
                                echo "<div class='alert alert-danger' role='alert'>{$resultado['message']}</div>";
                            }
                        }
                    }
                ?>
                </div>
            </main>
        </div>
    </div>
    <!--footer-->
    <?php
        include "footer.php";
    ?>
</body>
</html>
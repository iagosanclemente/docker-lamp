<?php
// inicializar.php
include 'init.php'; // Incluir las funciones de inicialización

// Llamar a la función de inicialización
$resultados = inicializarBaseDeDatos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD2. Tarea</title>
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
                    <h2>Inicializar</h2>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <?php
                    // Mostrar el resultado de las operaciones
                    foreach ($resultados as $resultado) {
                        if ($resultado['status'] == 'success') {
                            echo "<div class='alert alert-success' role='alert'>{$resultado['message']}</div>";
                        } elseif ($resultado['status'] == 'info') {
                            echo "<div class='alert alert-warning' role='alert'>{$resultado['message']}</div>";
                        } elseif ($resultado['status'] == 'error') {
                            echo "<div class='alert alert-danger' role='alert'>{$resultado['message']}</div>";
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
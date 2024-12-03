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
                    <h2>Editar Tarea</h2>
                </div>
                <div class="container">
                    <form class="mb-5" action="editaTarea.php" method="post">
                        <?php

                        include "mysqli.php";

                        if(isset($_GET['id'])) {

                            $id = $_GET['id'];
                      
                            $result = selectTareas($id); // Debería devolver un array con 1 tarea
                            
                            if (!empty($result)) {
                                $tarea = $result[0];
                            }
                        }

                        ?>
                        <div class="mb-3">
                            <p>ID : <input class="form-control" type="text" name="id_tarea" value="<?php echo $tarea['id']; ?>" readonly/></p>
                        </div>
                        <div class="mb-3">
                            <p>Titulo : <input class="form-control" type="text" name="titulo_tarea" value="<?php echo $tarea['titulo']; ?>" required/></p>
                        </div>
                        <div class="mb-3">
                            <p>Descripción : <input class="form-control" type="text" name="descripcion_tarea" value="<?php echo $tarea['descripcion']; ?>" required/></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-select" name="estado_tarea" required>
                                <option value="pendiente">Pendiente</option>
                                <option value="en_proceso">En proceso</option>
                                <option value="completa">Completa</option> 
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Usuario</label>
                            <select class="form-select" name="id_usuario" required>
                                <?php
                                    // DBE MOSTRAR USUARIOS CREADOS EN LA BASE DE DATOS
                                    include "pdo.php";

                                    $resultados = selectAllUsuarios();

                                    if ($resultados && count($resultados) > 0) {
                                        foreach ($resultados as $resultado) {
                                            echo '<option value="' . $resultado['id'] . '">' . $resultado['username'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">No hay usuarios disponibles</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </form>
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

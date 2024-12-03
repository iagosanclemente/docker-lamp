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
                    <h2>Lista de Tareas</h2>
                </div>
                <div class="table">
                    <table class="table table-striped table-hover">
                        <thead class="thead">
                            <tr>                            
                                <th>Identificador</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Usuario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            // Incluir el archivo utils.php
                            include 'mysqli.php';

                            $result = selectTareas();      

                            if (!empty($result)) { 
                                foreach ($result as $row) {
                                    echo "<tr><td>{$row['id']}</td><td>{$row['titulo']}</td><td>{$row['descripcion']}</td><td>{$row['estado']}<td>{$row['username']}</td></td>
                                    <td> 
                                        <a href='editaTareaForm.php?id={$row['id']}' class='btn btn-primary btn-sm'>Editar</a>
                                        <a href='borraTarea.php?id={$row['id']}&id_usuario={$row['id_usuario']}' class='btn btn-danger btn-sm'>Borrar</a>
                                    </td></tr>";
                                }
                            }
                            else {
                              echo "Sin resultados";
                            }
                        ?>
                        </tbody>
                    </table>
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
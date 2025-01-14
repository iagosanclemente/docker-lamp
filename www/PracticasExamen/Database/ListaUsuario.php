<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD3. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!--menu-->
            <?php
                include "menu.php";
             ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Lista de Usuarios</h2>
                </div>
                <div class="table">
                    <table class="table table-striped table-hover">
                        <thead class="thead">
                            <tr>                            
                                <th>Identificador</th>
                                <th>Username</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Contraseña</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            // Incluir el archivo utils.php
                            include 'pdo.php';

                            // O bien accede directamente al array global si has definido $listaTareas en utils.php
                            $usuarios = selectAllUsuarios();

                            // Mostrar las tareas en una tabla
                            foreach ($usuarios as $usuario) {
                                echo "<tr><td>{$usuario['id']}</td><td>{$usuario['username']}</td><td>{$usuario['nombre']}</td><td>{$usuario['apellidos']}</td><td>{$usuario['contrasena']}</td>
                                <td> 
                                    <a href='editaUsuarioForm.php?id={$usuario['id']}' class='btn btn-primary btn-sm'>Editar</a>
                                    <a href='borraUsuario.php?id={$usuario['id']}' class='btn btn-danger btn-sm' onclick='return'>Borrar</a>
                                </tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
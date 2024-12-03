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
        include "pdo.php";
        
        if (isset($_GET['id'])) {
            $usuarioID = $_GET['id'];

            $usuarios = selectAllUsuarios($usuarioID); // <----- Siempre devuelve un array dentro de otro array
            $usuario = $usuarios[0];

        }
        // HACEMOS UN SELECT DEL USUARIO EN LA BASE DE DATOS , LE PONEMOS LOS VALUES EN CADA UNO DE LOS INPUTS
    ?>
    <div class="container-fluid">
        <div class="row">
            <!--menu-->
            <?php
                include "menu.php";
             ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Editar Usuario</h2>
                </div>
                <div class="container">
                    <form class="mb-5" action="editaUsuario.php" method="post">
                        <input type="hidden" name="action" value="create">
                        <div class="mb-3">
                            <p>ID : <input class="form-control" type="text" name="id_usuario" value="<?php echo $usuario['id']; ?>" readonly/></p>
                        </div>
                        <div class="mb-3">
                            <p>Nombre : <input class="form-control" type="text" name="nombre_usuario" value="<?php echo $usuario['nombre']; ?>" required/></p>
                        </div>
                        <div class="mb-3">
                            <p>Apellidos : <input class="form-control" type="text" name="apellidos_usuario" value="<?php echo $usuario['apellidos']; ?>" required/></p>
                        </div>
                        <div class="mb-3">
                            <p>Username : <input class="form-control" type="text" name="username_usuario" value="<?php echo $usuario['username']; ?>" required/></p>
                        </div>
                        <div class="mb-3">
                            <p>Password : <input class="form-control" type="text" name="password_usuario" value="<?php echo $usuario['contrasena']; ?>" required/></p>
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
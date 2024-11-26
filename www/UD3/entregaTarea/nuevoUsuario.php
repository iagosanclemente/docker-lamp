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
        echo createHeader();
    ?>
    <div class="container-fluid">
        <div class="row">
            <!--menu-->
            <?php
                include "menu.php";
                echo createMenu();
             ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Nueva Tarea</h2>
                </div>
                <div class="container">
                    <form class="mb-5" action="utils.php" method="post">
                        <div class="mb-3">
                            <label class="form-label">Crear Tarea</label>
                            <p>Nombre : <input class="form-control" type="text" name="nombre_usuario" required/></p>
                        </div>
                        <div class="mb-3">
                            <p>Apellidos : <input class="form-control" type="text" name="apellidos_usuario" required/></p>
                        </div>
                        <div class="mb-3">
                            <p>Username : <input class="form-control" type="text" name="username_usuario" required/></p>
                        </div>
                        <div class="mb-3">
                            <p>Password : <input class="form-control" type="password" name="password_usuario" required/></p>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <!--footer-->
    <?php
        include "footer.php";
        echo createFooter();
    ?>
</body>
</html>

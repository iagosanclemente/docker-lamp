<?php 

    function createMenu() {
        return'
        <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/UD2/entregaTarea/">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/UD2/entregaTarea/listaTareas.php">
                            Mis Tareas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/UD2/entregaTarea/nuevaForm.php">
                            Nueva Tarea
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        ';
    }

?>
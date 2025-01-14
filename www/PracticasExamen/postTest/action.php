<?php

if($_SERVER['REQUEST_METHOD']=='POST') {

    $nombre = htmlspecialchars($_POST['user_name']);
    $reg = "/^[A-Za-z][a-zA-Z ]{2,19}$/";



    if($nombre != null) {
        if(preg_match($reg,$nombre)) {
            echo "Hola, " . $nombre . " ¡Bienvenido!";
        }     else {
            echo "EL NOMBRE INTRODUCIDO NO ES VÁLIDO";
        }
    }else {
        echo "INTRODUCE UN NOMBRE";
    }

}

?>
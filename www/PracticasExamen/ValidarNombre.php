<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        $nombre = "Alicia";
        $rgxp = "/^[A-Z][a-z]{2,19}$/"; // Expresión regular corregida

        if ($nombre !== null) {
            if (preg_match($rgxp, $nombre)) {
                echo "<p> NOMBRE REGISTRADO CORRECTAMENTE </p>";
            } else {
                echo "<p> ERROR NOMBRE NO VÁLIDO: Por favor introduce un nombre que comience con una letra mayúscula, tenga más de 3 caracteres y menos de 20. </p>";
            }
        } else {
            echo "<p> ERROR NOMBRE NO VÁLIDO: Por favor introduce el nombre. </p>";
        }

    ?>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        $arrayNum = [1,2,3,4,5,6,7,8,9,10];
        $sumaTotal = 0;

        foreach ($arrayNum as $numero) {

            echo "<p>" .$numero. "</p>";
            $sumaTotal += $numero;

        }

        echo "<p> SUMA TOTAL = " . $sumaTotal . "</p>";

    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        $ArrayEnteros = [120 , 145 , 3 , 58 , 89 , 129 , 6 , 64 ];
        $pares = [];

        for($i=0;$i<count($ArrayEnteros);$i++) {
            if ($ArrayEnteros[$i]%2 === 0) {
                array_push($pares,$ArrayEnteros[$i]);
            }
        }

        echo print_r($pares);
    ?>
</body>
</html>
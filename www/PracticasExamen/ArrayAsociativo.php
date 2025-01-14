<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        $estudiantes =[ ['id' => 'Laura' , 'nota' => 6] 
        , ['id' => 'Carlos' , 'nota' => 3] , 
        ['id' => 'Marta' , 'nota' => 9]];

        $masAlta = null;
        $notas = [];
        $notaMedia = 0;

        foreach($estudiantes as $stu) {

            if($masAlta === null || $stu['nota'] > $masAlta['nota']) {
                $masAlta = $stu;
            }

            array_push($notas,$stu['nota']);

        }

        $notaMedia = array_sum($notas)/count($estudiantes);

        echo "<p>Nota media = " . $notaMedia . "</p>";
        var_dump($masAlta);
        echo "<p>Nota más alta = " . $masAlta['nota'] . " de " . $masAlta['id'] . "</p>";

    ?>
</body>
</html>
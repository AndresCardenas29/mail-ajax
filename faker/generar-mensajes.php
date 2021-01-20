<?php 
    require_once 'vendor/fzaninotto/faker/src/autoload.php';

    $faker = Faker\Factory::create();

    $conn = mysqli_connect(
        'localhost', 
        'nekdress', 
        'root',     
        'notify'
    );

    date_default_timezone_set('America/Bogota');
    $hora_actual = date('Y-m-d H:i:s');

    foreach(range(1,25) as $reg){

        $destinario =  'andres1';
        $remitente =  '$faker->name;';
        $mensaje =  'hello!';

        $query = "INSERT INTO mensajes (destinario,remitente,mensaje,hora) VALUES (
            'andres1',
            '{$faker->name}',
            '{$faker->text}',
            '$hora_actual'
        )";

         $result = mysqli_query($conn, $query);

        if(!$result){
            die('La consulta ha fallado '.mysqli_error($conn));
        }

    }

    mysqli_close($conn);

?>
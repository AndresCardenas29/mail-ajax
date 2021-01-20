<?php 
    include('conection.php');
    date_default_timezone_set('America/Bogota');
    $hora_actual = date('Y-m-d H:i:s');

    if( isset($_POST['destinario']) ){
        $destinario =  $_POST['destinario'];
        $remitente =  $_POST['remitente'];
        $mensaje =  $_POST['mensaje'];

        $query = "INSERT INTO mensajes (destinario,remitente,mensaje,hora) VALUES (
            '$destinario',
            '$remitente',
            '$mensaje',
            '$hora_actual'
        )";

        $result = mysqli_query($conn, $query);
        if(!$result){
            die('La consulta ha fallado '.mysqli_error($conn));
        }

        echo 'se ha agregado';
    }
?>
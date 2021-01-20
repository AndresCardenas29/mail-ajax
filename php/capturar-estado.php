<?php 
include('conection.php');

if( isset($_POST['estado']) ){
    $estado =  $_POST['estado'];
    $usuario = $_POST['usuario'];

$query = "SELECT * FROM mensajes WHERE estado = $estado AND destinario = '$usuario'";

    $result = mysqli_query($conn, $query);
    if(!$result){
        die('La consulta ha fallado '.mysqli_error($conn));
    }

    $cantidad = mysqli_num_rows($result);

    echo $cantidad;
}
?>
<?php 
include('conection.php');

if( isset($_POST['id']) ){
    $id =  $_POST['id'];

    $query = "UPDATE mensajes SET estado = 1 WHERE id = $id";

    $result = mysqli_query($conn, $query);
    if(!$result){
        die('La consulta ha fallado '.mysqli_error($conn));
    }
}
?>
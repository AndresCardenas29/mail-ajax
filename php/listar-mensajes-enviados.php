<?php 


include('conection.php');

$usuario = $_POST['usuario'];

if(!empty($usuario)){
    $query = "SELECT * FROM mensajes WHERE remitente = '$usuario'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die('Query Error' . mysqli_error($conn));
    }

    $json = array();
    $total = mysqli_num_rows($result);

    while($row = mysqli_fetch_array($result)){
        $json[] = array(
            'id' => $row['id'],
            'remitente' => $row['remitente'],
            'destinario' => $row['destinario'],
            'mensaje' => $row['mensaje'],
            'estado' => $row['estado'],
            'hora' => $row['hora'],
            'total' => $total
        );
    }

    mysqli_close($conn);

    $jsonString = json_encode($json);
    echo $jsonString;
}

?>
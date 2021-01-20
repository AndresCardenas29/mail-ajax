<?php 

    include('conection.php');

    $id = $_POST['id'];

    if(!empty($id)){
        $query = "SELECT * FROM mensajes WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die('Query Error' . mysqli_error($conn));
        }

        $json = array();

        while($row = mysqli_fetch_array($result)){
            $json[] = array(
                'id' => $row['id'],
                'remitente' => $row['remitente'],
                'destinario' => $row['destinario'],
                'mensaje' => $row['mensaje'],
                'estado' => $row['estado'],
                'hora' => $row['hora']
            );
        }

        mysqli_close($conn);

        $jsonString = json_encode($json);
        echo $jsonString;
    }
?>
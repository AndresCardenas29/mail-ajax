<?php 
    include('conection.php');

    $search = $_POST['search'];

    if(!empty($search)){
        $query = "SELECT * FROM usuarios WHERE usuario LIKE '$search%'";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die('Query Error' . mysqli_error($conn));
        }

        $json = array();

        while($row = mysqli_fetch_array($result)){
            $json[] = array(
                'usuario' => $row['usuario'],
                'name' => $row['nombre'],
                'clave' => $row['clave']
            );
        }

        $jsonString = json_encode($json);
        echo $jsonString;
    }
?>
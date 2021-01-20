<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


session_start();

include('conection.php');

$usuario = $_POST['user'];
$clave = $_POST['clave'];

$query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";

$result = mysqli_query($conn, $query);

$usr = mysqli_num_rows($result);
$datos = mysqli_fetch_assoc($result);

echo $usr;

if ($usr == 1) {
    echo $datos['nombre'];
    $_SESSION['login'] = true;
    $_SESSION['id'] = $datos['id'];
    $_SESSION['nombre'] = $datos['nombre'];
    $_SESSION['usuario'] = $datos['usuario'];
    $_SESSION['clave'] = $datos['clave'];
    header("Location: ../index.php");
} else {
    echo "No funca, que sad. >:C";
}

mysqli_close($conn);

?>
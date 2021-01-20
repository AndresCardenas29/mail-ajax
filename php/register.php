<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
session_start();

include('conection.php');

$nombre = $_POST['nameR'];
$usuario = $_POST['userR'];
$clave = $_POST['claveR'];

$query = "INSERT INTO usuarios(nombre, usuario, clave) VALUES (
    '$nombre','$usuario','$clave'
)";

if (mysqli_query($conn, $query)) {
    header("Location: ../login.php");
} else {
    echo "No funca, que sad. >:C";
    echo mysqli_error($conn);
}

mysqli_close($conn);
?>
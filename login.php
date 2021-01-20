<?php 

session_start();

if(isset($_SESSION['login']) == true){
    header("Location: index.php");
}

?>
<!doctype html>
<html lang="es">

<head>
  <title>Login - Mail</title>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="resoruces/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="fa4/font-awesome.min.css">
  <style>
    body {
      width: 100vw;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: rgb(250, 240, 240);
    }

    .contenedor {
      width: 350px;
      /* height: 400px; */
      box-shadow: 0 0 6px rgba(0, 0, 0, .4);
      border-radius: 8px;
      padding: 20px;
      text-align: center;
      background: #fff;
    }

    .registro {
      width: 100vw;
      height: 100vh;
      position: fixed;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1000;
      display: none;
    }

    .registro .contenedor-registro{
      width: 380px;
      padding: 20px;
      background: #fff;
      border-radius: 8px;
      text-align: center;
      box-shadow: 0 0 6px rgba(0, 0, 0, .4);
    }
  </style>

</head>

<body>
  <div class="registro">
    <div class="contenedor-registro">
      <h1 class="display-4">Mail Registro</h1>
    <form action="php/register.php" method="POST">
      <div class="form-group">
        <label for="">Nombre</label>
        <input type="text" class="form-control" name="nameR" aria-describedby="helpId" placeholder="">
        <label for="">Usuario</label>
        <input type="text" class="form-control" name="userR" aria-describedby="helpId" placeholder="">
        <label for="">Contrasena</label>
        <input type="password" class="form-control" name="claveR" aria-describedby="helpId" placeholder="">
      </div>
      <input class="btn btn-primary" type="submit" value="Registrarse">
    </form>
    <button type="button" class="btn btn-danger mt-3 regresar">Regresar</button>
    </div>
  </div>

  <div class="contenedor">
    <h1 class="display-4">Mail-Login</h1>
    <form action="php/login.php" method="POST">
      <div class="form-group">
        <label for="">Usuario</label>
        <input type="text" class="form-control" name="user" id="user" aria-describedby="helpId" placeholder="">
        <label for="">Contrasena</label>
        <input type="password" class="form-control" name="clave" id="clave" aria-describedby="helpId" placeholder="">
      </div>
      <input class="btn btn-primary" type="submit" value="Entrar">
    </form>
    <input name="registro" id="registro" class="btn btn-secondary mt-3" type="button" value="Registrarse">
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="resoruces/bootstrap/js/jquery-3.3.1.slim.min.js">
  </script>
  <script src="resoruces/bootstrap/js/popper.min.js"></script>
  <script src="resoruces/bootstrap/js/bootstrap.min.js"></script>
<script src="resoruces/js/login.js"></script>
  

</body>

</html>